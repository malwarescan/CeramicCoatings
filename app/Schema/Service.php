<?php

namespace App\Schema;

use App\Core\Env;

class Service
{
    private string $serviceType;
    private string $city;
    private array $location;

    public function __construct(string $serviceType, string $city, array $location)
    {
        $this->serviceType = $serviceType;
        $this->city = $city;
        $this->location = $location;
    }

    public function generate(): array
    {
        return [
            '@type' => 'Service',
            'serviceType' => $this->serviceType,
            'areaServed' => [
                '@type' => 'City',
                'name' => $this->city . ', FL',
                'geo' => [
                    '@type' => 'GeoCoordinates',
                    'latitude' => (float) $this->location['lat'],
                    'longitude' => (float) $this->location['lng']
                ]
            ],
            'provider' => [
                '@type' => 'LocalBusiness',
                'name' => Env::get('APP_NAME'),
                'telephone' => Env::get('APP_PHONE'),
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => Env::get('APP_ADDRESS'),
                    'addressLocality' => 'Miami',
                    'addressRegion' => 'FL',
                    'postalCode' => '33101',
                    'addressCountry' => 'US'
                ]
            ],
            'offers' => [
                '@type' => 'Offer',
                'priceRange' => '$1000-$3000',
                'availability' => 'https://schema.org/InStock',
                'validFrom' => date('Y-m-d'),
                'validThrough' => date('Y-m-d', strtotime('+1 year'))
            ],
            'description' => "Professional {$this->serviceType} services in {$this->city}, Florida. Protect your vehicle from UV, salt air, humidity, and lovebugs with long-lasting ceramic coatings."
        ];
    }
}
