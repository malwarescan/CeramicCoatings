<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Simple JSON-LD validation script
// Usage: php validate_jsonld.php <url>

$url = $argv[1] ?? 'http://localhost:8080/';

echo "Validating JSON-LD for: {$url}\n";
echo str_repeat('-', 50) . "\n";

// Fetch the page
$html = @file_get_contents($url);

if ($html === false) {
    echo "ERROR: Could not fetch URL\n";
    exit(1);
}

// Extract JSON-LD scripts
preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $html, $matches);

if (empty($matches[1])) {
    echo "WARNING: No JSON-LD found on page\n";
    exit(0);
}

$schemas = [];
$errors = [];

foreach ($matches[1] as $index => $jsonString) {
    $jsonString = trim($jsonString);
    $data = json_decode($jsonString, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        $errors[] = "Schema #" . ($index + 1) . ": Invalid JSON - " . json_last_error_msg();
        continue;
    }
    
    $type = $data['@type'] ?? 'Unknown';
    
    if (isset($schemas[$type])) {
        $errors[] = "Duplicate schema type: {$type}";
    }
    
    $schemas[$type] = $data;
    echo "✓ Found valid {$type} schema\n";
}

echo str_repeat('-', 50) . "\n";
echo "Summary:\n";
echo "  Total schemas: " . count($matches[1]) . "\n";
echo "  Valid schemas: " . count($schemas) . "\n";
echo "  Errors: " . count($errors) . "\n";

if (!empty($errors)) {
    echo "\nErrors:\n";
    foreach ($errors as $error) {
        echo "  - {$error}\n";
    }
    exit(1);
}

echo "\nAll JSON-LD schemas are valid!\n";
exit(0);

