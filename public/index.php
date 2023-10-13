<?php

require_once __DIR__ . "/../vendor/autoload.php";

// Get all routes
$routes = require_once __DIR__ . "/../routes/web.php";
start_session();

$request = $_SERVER['REQUEST_URI'];
$request = explode('?', $request)[0] ?? '';

if (isset($routes[$request])) {

    $controller = $routes[$request][0] ?? null;

    $action = $routes[$request][1] ?? null;
    if ($controller && $action) {
        $controller = new $controller();
        $controller->$action();
    }
} else {
    throw new \Exception("404 not found");
}
