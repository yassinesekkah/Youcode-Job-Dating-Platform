<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, string $action): void
    {
        $this->routes["GET"][$path] = $action;
    }

    public function post(string $path, string $action): void
    {
        $this->routes["POST"][$path] = $action;
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if ($url === '') {
            $url = '/';
        }

        if (!isset($this->routes[$method][$url])) {
            http_response_code(404);
            View::render('errors/404');
            return;
        }

        [$controller, $action] = array_map(
            'trim',
            explode("@", $this->routes[$method][$url])
        );

        $controllerClass = 'App\\Controllers\\' . $controller;
        ///check wach kayna l class bach netfadat fatal error
        if (!class_exists($controllerClass)) {
            http_response_code(500);
            echo "Controller not found";
            return;
        }
        
        $controllerInstance = new $controllerClass();
        ///check wach kayna l method
        if (!method_exists($controllerInstance, $action)) {
            http_response_code(500);
            echo "Method not found";
            return;
        }

        $controllerInstance->$action();
    }
}
