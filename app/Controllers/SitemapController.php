<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Response;
use App\Core\Util;
use App\Models\Matrix;
use App\Models\Locations;

class SitemapController extends Controller
{
    private Matrix $matrix;
    private Locations $locations;

    public function __construct()
    {
        parent::__construct();
        $this->matrix = new Matrix();
        $this->locations = new Locations();
    }

    public function index(): void
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        $baseUrl = $this->getBaseUrl();
        $lastmod = date('Y-m-d');
        
        $xml .= Util::generateSitemapUrl($baseUrl . '/sitemap-matrix.xml', $lastmod, 'daily', 0.8);
        $xml .= Util::generateSitemapUrl($baseUrl . '/sitemap-guides.xml', $lastmod, 'weekly', 0.7);
        $xml .= Util::generateSitemapUrl($baseUrl . '/sitemap-cities.xml', $lastmod, 'weekly', 0.6);
        
        $xml .= '</sitemapindex>';
        
        Response::xml($xml);
    }

    public function matrix(): void
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        $baseUrl = $this->getBaseUrl();
        $lastmod = date('Y-m-d');
        
        // Add home page
        $xml .= Util::generateSitemapUrl($baseUrl, $lastmod, 'weekly', 1.0);
        
        // Add matrix pages
        foreach ($this->matrix->iterAllRows() as $row) {
            $url = $baseUrl . '/' . $row['service'] . '/' . $row['city'];
            if (!empty($row['vehicle_type'])) {
                $url .= '/' . $row['vehicle_type'];
            }
            $xml .= Util::generateSitemapUrl($url, $lastmod, 'monthly', 0.6);
        }
        
        $xml .= '</urlset>';
        
        Response::xml($xml);
    }

    public function guides(): void
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        $baseUrl = $this->getBaseUrl();
        $lastmod = date('Y-m-d');
        
        $guides = [
            'water-spot-removal',
            'wash-routine',
            'lovebug-season',
            'gelcoat-oxidation'
        ];
        
        foreach ($guides as $guide) {
            $url = $baseUrl . '/guides/' . $guide;
            $xml .= Util::generateSitemapUrl($url, $lastmod, 'monthly', 0.7);
        }
        
        $xml .= '</urlset>';
        
        Response::xml($xml);
    }

    public function cities(): void
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        $baseUrl = $this->getBaseUrl();
        $lastmod = date('Y-m-d');
        
        $services = $this->matrix->getServices();
        $cities = $this->locations->getAll();
        
        foreach ($services as $service) {
            foreach ($cities as $city) {
                $url = $baseUrl . '/' . $service . '/' . strtolower($city['city']);
                $xml .= Util::generateSitemapUrl($url, $lastmod, 'monthly', 0.5);
            }
        }
        
        $xml .= '</urlset>';
        
        Response::xml($xml);
    }

    private function getBaseUrl(): string
    {
        return 'https://yourdomain.com'; // Update with actual domain
    }
}
