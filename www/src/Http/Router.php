<?php

namespace App\Http;

class Router
{
    private static array $routes = [];

    public function __construct(
        private string $method,
        private string $path,
        private string $controller,
        private array $routerMiddlewares = []
    ) {
        $this->register();
    }

    public static function get(string $path, string $controller): self
    {
        return new self('GET', $path, $controller);
    }

    public static function post(string $path, string $controller): self
    {
        return new self('POST', $path, $controller);
    }

    public static function put(string $path, string $controller): self
    {
        return new self('PUT', $path, $controller);
    }

    public static function delete(string $path, string $controller): self
    {
        return new self('DELETE', $path, $controller);
    }

    protected function register(): void
    {
        self::$routes[] = [
            'method'      => $this->method,
            'path'        => $this->path,
            'controller'  => $this->controller,
            'middlewares' => $this->routerMiddlewares,
        ];
    }

    public function middlewares(string ...$middlewares): self
    {
        array_pop(self::$routes);
        return new self($this->method, $this->path, $this->controller, $middlewares);
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }
}
