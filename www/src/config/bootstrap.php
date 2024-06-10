<?php

use App\Http\Request;
use App\Http\Response;

/**
 * Function to dispatch the routes
 *
 * @param array $routes
 * @return void
 */
function dispatch(array $routes, array $factories, array $middlewares, array $databaseConfig): void
{
    $url = $_GET['url'] ?? '/';

    $url !== '/' && $url = rtrim($url, '/');

    $routerFound = false;

    $request  = new Request();
    $response = new Response();

    foreach ($routes as $route) {
        $pattern = "#^" . preg_replace('/{id}/', "(\w+)", $route['path']) . "$#";

        if (preg_match($pattern, $url, $matches)) {
            $routerFound = true;

            array_shift($matches);

            foreach ($route['middlewares'] as $middleware) {
                if (array_key_exists($middleware, $middlewares)) {
                    $middlewareClass = $middlewares[$middleware];

                    $extendMiddleware = new $middlewareClass();

                    $extendMiddleware->handle($request, $response);
                }
            }

            if ($request->getMethod() !== $route['method']) {
                $response->json(['message' => 'Sorry, method not allowed.'], 405);
            }

            if (array_key_exists($route['controller'], $factories)) {
                $factoryClass = $factories[$route['controller']];

                $extendFactory = new $factoryClass();

                $controller = $extendFactory->generateInstance($databaseConfig);
                $controller->handle($request, $response, $matches);
            }
        }
    }

    if (!$routerFound) {
        $response->json(['message' => 'Sorry, router not found.'], 404);
    }
}
