<?php

namespace App\Models;

class Faq
{
    private array $data = [];
    private string $dataFile;

    public function __construct()
    {
        $this->dataFile = __DIR__ . '/../../data/faqs_florida.json';
        $this->loadData();
    }

    private function loadData(): void
    {
        if (file_exists($this->dataFile)) {
            $this->data = json_decode(file_get_contents($this->dataFile), true) ?: [];
        }
    }

    public function getAll(): array
    {
        return $this->data;
    }

    public function getRandom(int $count = 10): array
    {
        if (count($this->data) <= $count) {
            return $this->data;
        }
        
        $keys = array_rand($this->data, $count);
        if (!is_array($keys)) {
            $keys = [$keys];
        }
        
        $results = [];
        foreach ($keys as $key) {
            $results[] = $this->data[$key];
        }
        
        return $results;
    }

    public function search(string $query): array
    {
        $results = [];
        $query = strtolower($query);
        
        foreach ($this->data as $faq) {
            $searchText = strtolower($faq['q'] . ' ' . $faq['a']);
            if (strpos($searchText, $query) !== false) {
                $results[] = $faq;
            }
        }
        
        return $results;
    }

    public function getByKeywords(array $keywords): array
    {
        $results = [];
        
        foreach ($this->data as $faq) {
            $text = strtolower($faq['q'] . ' ' . $faq['a']);
            
            foreach ($keywords as $keyword) {
                if (strpos($text, strtolower($keyword)) !== false) {
                    $results[] = $faq;
                    break;
                }
            }
        }
        
        return $results;
    }

    public function getRelevant(string $service, string $city, ?string $vehicleType = null): array
    {
        $keywords = [$service, $city];
        
        if ($vehicleType) {
            $keywords[] = $vehicleType;
        }
        
        // Add Florida-specific keywords
        $keywords = array_merge($keywords, [
            'florida', 'uv', 'salt', 'humidity', 'lovebug', 'water spot',
            'coating', 'ceramic', 'marine', 'boat', 'gelcoat'
        ]);
        
        $results = $this->getByKeywords($keywords);
        
        // Limit to 8 most relevant
        return array_slice($results, 0, 8);
    }

    public function getCount(): int
    {
        return count($this->data);
    }

    public function add(array $faq): void
    {
        $this->data[] = $faq;
        $this->save();
    }

    public function update(int $index, array $faq): void
    {
        if (isset($this->data[$index])) {
            $this->data[$index] = $faq;
            $this->save();
        }
    }

    public function delete(int $index): void
    {
        if (isset($this->data[$index])) {
            unset($this->data[$index]);
            $this->data = array_values($this->data); // Reindex
            $this->save();
        }
    }

    private function save(): void
    {
        file_put_contents($this->dataFile, json_encode($this->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}
