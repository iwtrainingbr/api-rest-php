<?php

declare(strict_types=1);

use App\Controller\Admin\RoleAdminController;
use App\Controller\AuthController;
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
    'admin' => [
        'GET' => addRoute(RoleAdminController::class, 'list'),
    ],

    'login' => [
        'GET' => addRoute(RoleAdminController::class, 'login'),
        'POST' => addRoute(RoleAdminController::class, 'login'),
    ],

    'logout' => [
        'GET' => addRoute(RoleAdminController::class, 'logout'),
    ],

    'auth' => [
        'POST' => addRoute(AuthController::class, 'login'),
    ],

    'usuarios' => [
        'GET' => addRoute(UserController::class, 'list'),
        'DELETE' => addRoute(UserController::class, 'remove'),
        'PATCH' => addRoute(UserController::class, 'edit'),
        'POST' => addRoute(UserController::class, 'add'),
    ],

    'roles' => [
        'GET' => addRoute(RoleController::class, 'list'),
        'POST' => addRoute(RoleController::class, 'add'),
        'PATCH' => addRoute(RoleController::class, 'edit'),
        'DELETE' => addRoute(RoleController::class, 'remove'),
    ],
];
