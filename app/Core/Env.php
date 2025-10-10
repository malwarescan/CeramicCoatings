<?php

namespace App\Core;

class Env
{
    private static array $data = [];

    public static function load(): void
    {
        $envFile = __DIR__ . '/../../.env';
        
        if (file_exists($envFile)) {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            
            foreach ($lines as $line) {
                if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
                    [$key, $value] = explode('=', $line, 2);
                    self::$data[trim($key)] = trim($value);
                }
            }
        }
        
        // Set defaults
        self::$data['BASE_URL'] = self::$data['BASE_URL'] ?? '/';
        self::$data['APP_NAME'] = self::$data['APP_NAME'] ?? 'Florida Ceramic Coatings';
        self::$data['APP_PHONE'] = self::$data['APP_PHONE'] ?? '(555) 123-4567';
        self::$data['APP_ADDRESS'] = self::$data['APP_ADDRESS'] ?? '123 Main St, Miami, FL 33101';
        self::$data['APP_LAT'] = self::$data['APP_LAT'] ?? '25.7617';
        self::$data['APP_LNG'] = self::$data['APP_LNG'] ?? '-80.1918';
    }

    public static function get(string $key, $default = null)
    {
        return self::$data[$key] ?? $default;
    }

    public static function all(): array
    {
        return self::$data;
    }
}
