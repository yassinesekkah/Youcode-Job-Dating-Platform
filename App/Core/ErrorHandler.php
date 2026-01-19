<?php

namespace App\Core;

class ErrorHandler
{
    public static function handleException(\Throwable $e): void
    {
        http_response_code(500);

        if (APP_DEBUG) {
            echo "<h1>Exception</h1>";
            echo "<p><strong>Message:</strong> {$e->getMessage()}</p>";
            echo "<pre>{$e->getTraceAsString()}</pre>";
        } else {
            View::render('errors/500');
        }
    }

    public static function handleError(
        int $severity,
        string $message,
        string $file,
        int $line
    ): void {
        throw new \ErrorException($message, 0, $severity, $file, $line);
    }
}
