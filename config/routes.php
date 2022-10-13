<?php

declare(strict_types=1);

use App\Controller\RoleController;
use App\Controller\UserController;

function addRoute(string $controller, string $method): array
{
    return [
        'controller' => $controller,
        'method' => $method,
    ];
}

return [
    'usuarios' => [
        'GET' => addRoute(UserController::class, 'list'),
        'DELETE' => addRoute(UserController::class, 'remove'),
        'POST' => addRoute(UserController::class, 'add'),
    ],

    'roles' => [
        'GET' => addRoute(RoleController::class, 'list'),
        'POST' => addRoute(RoleController::class, 'add'),
        'PATCH' => addRoute(RoleController::class, 'edit'),
        'DELETE' => addRoute(RoleController::class, 'remove'),
    ],
];
