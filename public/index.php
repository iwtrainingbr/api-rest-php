<?php

include dirname(__DIR__).'/vendor/autoload.php';

header('Content-Type: application/json');

$url = $_SERVER['REQUEST_URI'];
$httpMethod = $_SERVER['REQUEST_METHOD'];

$routes = include '../config/routes.php';

if (false === isset($routes[$url])) {
    header('HTTP CODE', true, 404);
}

if (false === isset($routes[$url][$httpMethod])) {
    header('HTTP CODE', true, 405);
}

$controller = $routes[$url][$httpMethod]['controller'];
$method = $routes[$url][$httpMethod]['method']; 

(new $controller())->$method();

