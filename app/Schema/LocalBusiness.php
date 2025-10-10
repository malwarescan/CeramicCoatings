<?php

namespace App\Schema;

use App\Core\Env;

class LocalBusiness
{
    private ?array $location;

    public function __construct(?array $location = null)
    {
        $this->location = $location;
    }

    public function generate(): array
    {
        $schema = [
            '@type' => 'LocalBusiness',
            'name' => Env::get('APP_NAME'),
            'url' => Env::get('BASE_URL'),
            'telephone' => Env::get('APP_PHONE'),
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => Env::get('APP_ADDRESS'),
                'addressLocality' => 'Miami',
                'addressRegion' => 'FL',
                'postalCode' => '33101',
                'addressCountry' => 'US'
            ],
            'openingHours' => [
                'Mo-Fr 08:00-18:00',
                'Sa 09:00-16:00'
            ],
            'sameAs' => [
                'https://www.facebook.com/yourpage',
                'https://www.instagram.com/yourpage',
                'https://www.google.com/maps/place/yourbusiness'
            ]
        ];

        // Add geo coordinates if location provided
        if ($this->location) {
            $schema['geo'] = [
                '@type' => 'GeoCoordinates',
                'latitude' => (float) $this->location['lat'],
                'longitude' => (float) $this->location['lng']
            ];
        } else {
            $schema['geo'] = [
                '@type' => 'GeoCoordinates',
                'latitude' => (float) Env::get('APP_LAT'),
                'longitude' => (float) Env::get('APP_LNG')
            ];
        }

        return $schema;
    }
}
