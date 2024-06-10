<?php

namespace App\Http;

class Router
{
    /**
     * @var array
     */
    private static array $routes = [];

    public function __construct(
        private string $method,
        private string $path,
        private string $controller,
        private array $routerMiddlewares = []
    ) {
        $this->register();
    }

    /**
     * Create a new GET route.
     *
     * @param string $path
     * @param string $controller
     * @return self
     */
    public static function get(string $path, string $controller): self
    {
        return new self('GET', $path, $controller);
    }

    /**
     * Create a new POST route.
     *
     * @param string $path
     * @param string $controller
     * @return self
     */
    public static function post(string $path, string $controller): self
    {
        return new self('POST', $path, $controller);
    }

    /**
     * Create a new PUT route.
     *
     * @param string $path
     * @param string $controller
     * @return self
     */
    public static function put(string $path, string $controller): self
    {
        return new self('PUT', $path, $controller);
    }

    /**
     * Create a new DELETE route.
     *
     * @param string $path
     * @param string $controller
     * @return self
     */
    public static function delete(string $path, string $controller): self
    {
        return new self('DELETE', $path, $controller);
    }

    /**
     * Register the route.
     *
     * @return void
     */
    protected function register(): void
    {
        self::$routes[] = [
            'method'      => $this->method,
            'path'        => $this->path,
            'controller'  => $this->controller,
            'middlewares' => $this->routerMiddlewares,
        ];
    }

    /**
     * Add middlewares to the route.
     *
     * @param string ...$middlewares
     * @return self
     */
    public function middlewares(string ...$middlewares): self
    {
        array_pop(self::$routes);
        return new self($this->method, $this->path, $this->controller, $middlewares);
    }

    /**
     * Get all registered routes.
     *
     * @return array
     */
    public static function getRoutes(): array
    {
        return self::$routes;
    }
}
