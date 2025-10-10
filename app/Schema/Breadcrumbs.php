<?php

namespace App\Schema;

use App\Core\Env;

class Breadcrumbs
{
    private array $breadcrumbs;

    public function __construct(array $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
    }

    public function generate(): array
    {
        $itemListElement = [];
        $position = 1;

        foreach ($this->breadcrumbs as $breadcrumb) {
            $itemListElement[] = [
                '@type' => 'ListItem',
                'position' => $position,
                'name' => $breadcrumb['name'],
                'item' => Env::get('BASE_URL') . $breadcrumb['url']
            ];
            $position++;
        }

        return [
            '@type' => 'BreadcrumbList',
            'itemListElement' => $itemListElement
        ];
    }
}
