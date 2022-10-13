<?php

declare(strict_types=1);

namespace App\Response;

class JsonResponse
{
    public static function success(mixed $data = null, int $code = 200): void
    {
        if (null !== $data) {
            echo json_encode($data);
        }

        header('HTTP CODE', true, $code);
    }
}
