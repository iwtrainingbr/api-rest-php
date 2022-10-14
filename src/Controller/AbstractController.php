<?php

declare(strict_types=1);

namespace App\Controller;

abstract class AbstractController
{
    public function getId(): string|null
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);

        return $url[2] ?? null;
    }

    public function getRequestBody(): mixed
    {
        return json_decode(
            file_get_contents('php://input')
        ); 
    }
}

