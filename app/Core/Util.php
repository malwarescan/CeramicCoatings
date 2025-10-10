<?php

namespace App\Core;

class Util
{
    public static function slugify(string $text): string
    {
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
        $text = preg_replace('/[\s-]+/', '-', $text);
        return trim($text, '-');
    }

    public static function formatPhone(string $phone): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        if (strlen($phone) === 10) {
            return '(' . substr($phone, 0, 3) . ') ' . substr($phone, 3, 3) . '-' . substr($phone, 6);
        }
        
        return $phone;
    }

    public static function truncate(string $text, int $length = 150): string
    {
        if (strlen($text) <= $length) {
            return $text;
        }
        
        return substr($text, 0, $length) . '...';
    }

    public static function arrayToCsv(array $data, string $filename): void
    {
        $file = fopen($filename, 'w');
        
        if (!empty($data)) {
            fputcsv($file, array_keys($data[0]));
            
            foreach ($data as $row) {
                fputcsv($file, $row);
            }
        }
        
        fclose($file);
    }

    public static function csvToArray(string $filename): array
    {
        $data = [];
        
        if (file_exists($filename)) {
            $file = fopen($filename, 'r');
            $headers = fgetcsv($file, 0, ',', '"', '\\');
            
            while (($row = fgetcsv($file, 0, ',', '"', '\\')) !== false) {
                if (count($row) === count($headers)) {
                    $data[] = array_combine($headers, $row);
                }
            }
            
            fclose($file);
        }
        
        return $data;
    }

    public static function generateSitemapUrl(string $url, ?string $lastmod = null, string $changefreq = 'monthly', float $priority = 0.5): string
    {
        $lastmod = $lastmod ?: date('Y-m-d');
        
        return "<url>\n" .
               "  <loc>{$url}</loc>\n" .
               "  <lastmod>{$lastmod}</lastmod>\n" .
               "  <changefreq>{$changefreq}</changefreq>\n" .
               "  <priority>{$priority}</priority>\n" .
               "</url>\n";
    }
}
