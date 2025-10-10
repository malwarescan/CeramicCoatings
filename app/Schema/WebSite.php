<?php

namespace App\Schema;

use App\Core\Env;

class WebSite
{
    public function generate(): array
    {
        return [
            '@type' => 'WebSite',
            'name' => Env::get('APP_NAME'),
            'url' => Env::get('BASE_URL'),
            'description' => 'Professional ceramic coating services across Florida. Protect your vehicle from UV, salt air, humidity, and lovebugs with long-lasting ceramic coatings.',
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => Env::get('BASE_URL') . '/?q={search_term_string}'
                ],
                'query-input' => 'required name=search_term_string'
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => Env::get('APP_NAME'),
                'url' => Env::get('BASE_URL')
            ]
        ];
    }
}
