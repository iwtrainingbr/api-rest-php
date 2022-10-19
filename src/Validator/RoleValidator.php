<?php

declare(strict_types=1);

namespace App\Validator;

class RoleValidator 
{
    public static function validatePost(mixed $request): void
    {
        if (false === isset($request->name)) {
            //gerando uma nova exceção, ou seja, gerando um erro customizado
            throw new \Exception('o atributo "name" é obrigatório');
        }

        if (strlen($request->name) < 3) {
            throw new \Exception('O atributo "name" precisa ter no minimo 03 caracterers');
        }
    }
}