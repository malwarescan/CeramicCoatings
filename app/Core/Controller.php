<?php

namespace App\Core;

abstract class Controller
{
    protected View $view;
    protected array $data = [];

    public function __construct()
    {
        $this->view = new View();
    }

    protected function render(string $template, array $data = []): string
    {
        return $this->view->render($template, array_merge($this->data, $data));
    }

    protected function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
        exit;
    }

    protected function redirect(string $url, int $status = 302): void
    {
        http_response_code($status);
        header("Location: {$url}");
        exit;
    }

    protected function setData(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    protected function getData(?string $key = null)
    {
        if ($key === null) {
            return $this->data;
        }
        return $this->data[$key] ?? null;
    }
}
