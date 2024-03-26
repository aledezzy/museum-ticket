<?php

//define the class router based on routes.php

class Router
{
    public function __construct()
    {
    }

    private $routes = [];

    public function addRoute(string $method, string $path, callable $handler)
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        ];
    }

    //define methd get
    public function get(string $path, callable $handler)
    {
        $this->addRoute('GET', $path, $handler);
    }
    //define method post
    public function post(string $path, callable $handler)
    {
        $this->addRoute('POST', $path, $handler);
    }
    public function put(string $path, callable $handler)
    {
        $this->addRoute('PUT', $path, $handler);
    }

    public function run()
{
    $method = $_SERVER['REQUEST_METHOD'];
    $path = $_SERVER['REQUEST_URI'];

    foreach ($this->routes as $route) {
        if ($route['method'] == $method && $route['path'] == $path) {
            call_user_func($route['handler']);
            return;
        }
    }

    // Se nessuna rotta corrisponde, invia un errore 404
    header("HTTP/1.0 404 Not Found");
    echo "404 Not Found";
}
}