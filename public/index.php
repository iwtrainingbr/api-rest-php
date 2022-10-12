<?php

//Carregando todos os arquivos do projeto
include dirname(__DIR__).'/vendor/autoload.php';

//definindo o tipo padrão de conteudo de resposta para json
header('Content-Type: application/json');

//recuperando a URL/endpoint que o cliente está acessando
$url = $_SERVER['REQUEST_URI'];

//recuperando o metodo http usado pelo cliente
$httpMethod = $_SERVER['REQUEST_METHOD'];

//trazendo as rotas definidas pra variavel $routes
$routes = include '../config/routes.php';

//testando se o endpoint foi definido
if (false === isset($routes[$url])) {
    header('HTTP CODE', true, 404);
    exit;
}

//testando se o endpoint possui aquele metodo HTTP
if (false === isset($routes[$url][$httpMethod])) {
    header('HTTP CODE', true, 405);
    exit;
}


$controller = $routes[$url][$httpMethod]['controller'];
$method = $routes[$url][$httpMethod]['method']; 

(new $controller())->$method();

