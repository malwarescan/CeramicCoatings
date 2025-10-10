<?php

namespace App\Models;

use App\Core\Util;

class Matrix
{
    private array $data = [];
    private string $cacheFile;
    private string $csvFile;

    public function __construct()
    {
        $this->csvFile = __DIR__ . '/../../matrix_data/convex_matrix.csv';
        $this->cacheFile = sys_get_temp_dir() . '/ceramic_matrix_cache.json';
        $this->loadData();
    }

    private function loadData(): void
    {
        // Try to load from cache first
        if (file_exists($this->cacheFile) && filemtime($this->cacheFile) > filemtime($this->csvFile)) {
            $this->data = json_decode(file_get_contents($this->cacheFile), true);
            return;
        }

        // Load from CSV and cache
        $this->data = Util::csvToArray($this->csvFile);
        file_put_contents($this->cacheFile, json_encode($this->data));
    }

    public function getServices(): array
    {
        $services = array_unique(array_column($this->data, 'service'));
        sort($services);
        return $services;
    }

    public function getCities(): array
    {
        $cities = array_unique(array_column($this->data, 'city'));
        sort($cities);
        return $cities;
    }

    public function findByCityService(string $city, string $service, ?string $vehicleType = null): array
    {
        $results = [];
        
        foreach ($this->data as $row) {
            if (strtolower($row['city']) === strtolower($city) && 
                strtolower($row['service']) === strtolower($service)) {
                
                if ($vehicleType === null || strtolower($row['vehicle_type']) === strtolower($vehicleType)) {
                    $results[] = $row;
                }
            }
        }
        
        return $results;
    }

    public function iterAllRows(): \Generator
    {
        foreach ($this->data as $row) {
            yield $row;
        }
    }

    public function getVehicleTypes(): array
    {
        $types = array_unique(array_column($this->data, 'vehicle_type'));
        $types = array_filter($types); // Remove empty values
        sort($types);
        return $types;
    }

    public function getPainPoints(): array
    {
        $points = array_unique(array_column($this->data, 'pain_point'));
        $points = array_filter($points); // Remove empty values
        sort($points);
        return $points;
    }

    public function getSegments(): array
    {
        $segments = array_unique(array_column($this->data, 'segment'));
        $segments = array_filter($segments); // Remove empty values
        sort($segments);
        return $segments;
    }

    public function getAllData(): array
    {
        return $this->data;
    }

    public function getCount(): int
    {
        return count($this->data);
    }

    public function search(string $query): array
    {
        $results = [];
        $query = strtolower($query);
        
        foreach ($this->data as $row) {
            $searchText = strtolower(implode(' ', $row));
            if (strpos($searchText, $query) !== false) {
                $results[] = $row;
            }
        }
        
        return $results;
    }
}
