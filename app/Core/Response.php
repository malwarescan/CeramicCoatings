<?php

namespace App\Core;

class Response
{
    public static function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
        exit;
    }

    public static function xml(string $xml, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/xml');
        echo $xml;
        exit;
    }

    public static function redirect(string $url, int $status = 302): void
    {
        http_response_code($status);
        header("Location: {$url}");
        exit;
    }

    public static function notFound(): void
    {
        http_response_code(404);
        echo "Page not found";
        exit;
    }

    public static function serverError(string $message = 'Internal Server Error'): void
    {
        http_response_code(500);
        echo $message;
        exit;
    }
}
