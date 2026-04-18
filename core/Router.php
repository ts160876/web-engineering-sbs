<?php

namespace Bukubuku\Core;

use Bukubuku\Core\Exception\NotFoundException;

class Router
{
    private array $routes;

    public function registerGet(string $path, callable|array|string $action)
    {
        $this->register('GET', $path, $action);
    }

    public function registerPost(string $path, callable|array|string $action)
    {
        $this->register('POST', $path, $action);
    }

    private function register(string $requestMethod, string $path, callable|array|string $action)
    {
        $this->routes[$requestMethod][$path] = $action;
    }

    public function resolve(): string
    {
        //Determine the action for the given request method and path.
        $requestMethod = Application::$app->request->getRequestMethod();
        $path = Application::$app->request->getPath();
        $action = $this->routes[$requestMethod][$path] ?? null;

        //Call the action, if it could be determined. Otherwise show 'Not found'.
        if ($action !== null) {
            if (is_callable($action)) {
                return call_user_func($action);
            } else {
                return (new View())->render($action);
            }
        } else {
            throw new NotFoundException();
        }
    }
}
