<?php

declare(strict_types=1);

use App\Controller\UserController;

function addRoute(string $controller, string $method): array
{
    return [
        'controller' => $controller,
        'method' => $method,
    ];
}

return [
    '/usuarios' => [
        'GET' => addRoute(UserController::class, 'list'),
        'DELETE' => addRoute(UserController::class, 'remove'),
        'POST' => addRoute(UserController::class, 'add'),
    ],
];
