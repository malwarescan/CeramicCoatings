<?php
require_once __DIR__.'/../vendor/autoload.php';

use App\Core\View;
use App\Controllers\HomeController;
use App\Controllers\CityController;

$view = new View(__DIR__.'/../app/Views');

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Very small router for demo
if ($path === '/' || $path === '') {
  $controller = new HomeController($view);
  echo $controller->index();
  exit;
}

if (preg_match('#^/(ceramic-coating|coating-maintenance|water-spot-removal|gelcoat-ceramic)/([a-z0-9\-]+)/?$#i', $path, $m)) {
  $controller = new CityController($view);
  echo $controller->show($m[1], $m[2]);
  exit;
}

http_response_code(404);
echo "<!doctype html><meta charset='utf-8'><title>404</title><body style='font-family:-apple-system,Segoe UI,Roboto,sans-serif;padding:40px'><h1>Not Found</h1><p>Route not defined.</p></body>";