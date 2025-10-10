<?php

namespace App\Schema;

use App\Core\Env;

class FaqPage
{
    private array $faqs;

    public function __construct(array $faqs)
    {
        $this->faqs = $faqs;
    }

    public function generate(): array
    {
        $mainEntity = [];

        foreach ($this->faqs as $faq) {
            $mainEntity[] = [
                '@type' => 'Question',
                'name' => $faq['q'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['a']
                ]
            ];
        }

        return [
            '@type' => 'FAQPage',
            'mainEntity' => $mainEntity,
            'about' => [
                '@type' => 'Thing',
                'name' => 'Ceramic Coating Services in Florida'
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => Env::get('APP_NAME'),
                'url' => Env::get('BASE_URL')
            ]
        ];
    }
}
