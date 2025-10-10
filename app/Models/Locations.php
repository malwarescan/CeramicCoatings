<?php

namespace App\Models;

class Locations
{
    private array $data = [];
    private string $dataFile;

    public function __construct()
    {
        $this->dataFile = __DIR__ . '/../../data/cities_fl.json';
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

    public function getByCity(string $city): ?array
    {
        foreach ($this->data as $location) {
            if (strtolower($location['city']) === strtolower($city)) {
                return $location;
            }
        }
        return null;
    }

    public function getByCounty(string $county): array
    {
        $results = [];
        foreach ($this->data as $location) {
            if (strtolower($location['county']) === strtolower($county)) {
                $results[] = $location;
            }
        }
        return $results;
    }

    public function getCoastal(): array
    {
        return array_filter($this->data, function($location) {
            return $location['coastal'] === true;
        });
    }

    public function getInland(): array
    {
        return array_filter($this->data, function($location) {
            return $location['coastal'] === false;
        });
    }

    public function getCounties(): array
    {
        $counties = array_unique(array_column($this->data, 'county'));
        sort($counties);
        return $counties;
    }

    public function search(string $query): array
    {
        $results = [];
        $query = strtolower($query);
        
        foreach ($this->data as $location) {
            $searchText = strtolower($location['city'] . ' ' . $location['county']);
            if (strpos($searchText, $query) !== false) {
                $results[] = $location;
            }
        }
        
        return $results;
    }

    public function getNearby(float $lat, float $lng, float $radius = 50): array
    {
        $results = [];
        
        foreach ($this->data as $location) {
            $distance = $this->calculateDistance($lat, $lng, $location['lat'], $location['lng']);
            if ($distance <= $radius) {
                $location['distance'] = $distance;
                $results[] = $location;
            }
        }
        
        // Sort by distance
        usort($results, function($a, $b) {
            return $a['distance'] <=> $b['distance'];
        });
        
        return $results;
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

    public function getCount(): int
    {
        return count($this->data);
    }

    private function calculateDistance(float $lat1, float $lng1, float $lat2, float $lng2): float
    {
        $earthRadius = 3959; // miles
        
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);
        
        $a = sin($dLat/2) * sin($dLat/2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLng/2) * sin($dLng/2);
        
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        
        return $earthRadius * $c;
    }

    public function isLovebugRegion(string $city): bool
    {
        $location = $this->getByCity($city);
        if (!$location) {
            return false;
        }
        
        // Lovebugs are common in central/north Florida, especially along I-75/I-10
        $lovebugCounties = [
            'Leon', 'Gadsden', 'Jefferson', 'Madison', 'Taylor', 'Lafayette',
            'Suwannee', 'Hamilton', 'Columbia', 'Baker', 'Union', 'Bradford',
            'Alachua', 'Gilchrist', 'Levy', 'Marion', 'Sumter', 'Lake',
            'Orange', 'Seminole', 'Volusia', 'Brevard', 'Indian River',
            'St. Lucie', 'Martin', 'Palm Beach', 'Broward', 'Miami-Dade'
        ];
        
        return in_array($location['county'], $lovebugCounties);
    }

    public function isHardWaterArea(string $city): bool
    {
        $location = $this->getByCity($city);
        if (!$location) {
            return false;
        }
        
        // Areas known for hard water in Florida
        $hardWaterCounties = [
            'Miami-Dade', 'Broward', 'Palm Beach', 'Martin', 'St. Lucie',
            'Indian River', 'Brevard', 'Volusia', 'Flagler', 'Putnam',
            'Marion', 'Lake', 'Orange', 'Seminole', 'Osceola', 'Polk'
        ];
        
        return in_array($location['county'], $hardWaterCounties);
    }
}
