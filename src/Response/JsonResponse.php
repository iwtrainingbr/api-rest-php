<?php

declare(strict_types=1);

namespace App\Response;

class JsonResponse
{
    public static function success(int $httpCode = 200): void
    {
        header('HTTP CODE', true, $httpCode);
    }
}
