<?php

declare(strict_types=1);

namespace App\Controller;

class UserController
{
    public function list(): void
    {
        $usuarioTeste = [
            'name' => 'Chiquim',
            'email' => 'chiquim@email.com',
        ];

        echo json_encode([
            $usuarioTeste,
            $usuarioTeste,
            $usuarioTeste,
        ]);
    }

    public function add(): void
    {
        header('HTTP CODE', true, 201);

        echo json_encode([
            'message' => 'Usuario cadastrado',
        ]);
    }

    public function remove(): void
    {
        header('HTTP CODE', true, 204);
    }
}