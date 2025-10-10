<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\Matrix;
use App\Models\Locations;
use App\Core\Util;

echo "Building sitemaps...\n";

$matrix = new Matrix();
$locations = new Locations();
$baseUrl = 'https://yourdomain.com'; // Update with actual domain

// Sitemap index
$indexXml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$indexXml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
$indexXml .= "  <sitemap>\n    <loc>{$baseUrl}/sitemap-matrix.xml</loc>\n    <lastmod>" . date('Y-m-d') . "</lastmod>\n  </sitemap>\n";
$indexXml .= "  <sitemap>\n    <loc>{$baseUrl}/sitemap-guides.xml</loc>\n    <lastmod>" . date('Y-m-d') . "</lastmod>\n  </sitemap>\n";
$indexXml .= "  <sitemap>\n    <loc>{$baseUrl}/sitemap-cities.xml</loc>\n    <lastmod>" . date('Y-m-d') . "</lastmod>\n  </sitemap>\n";
$indexXml .= '</sitemapindex>';

file_put_contents(__DIR__ . '/../public/sitemap.xml', $indexXml);
echo "Created sitemap.xml (index)\n";

// Matrix sitemap
$matrixXml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$matrixXml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
$matrixXml .= Util::generateSitemapUrl($baseUrl, date('Y-m-d'), 'weekly', 1.0);

foreach ($matrix->iterAllRows() as $row) {
    $url = $baseUrl . '/' . $row['service'] . '/' . strtolower($row['city']);
    if (!empty($row['vehicle_type'])) {
        $url .= '/' . $row['vehicle_type'];
    }
    $matrixXml .= Util::generateSitemapUrl($url, date('Y-m-d'), 'monthly', 0.6);
}

$matrixXml .= '</urlset>';
file_put_contents(__DIR__ . '/../public/sitemap-matrix.xml', $matrixXml);
echo "Created sitemap-matrix.xml (" . $matrix->getCount() . " URLs)\n";

// Guides sitemap
$guidesXml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$guidesXml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

$guides = ['water-spot-removal', 'wash-routine', 'lovebug-season', 'gelcoat-oxidation'];
foreach ($guides as $guide) {
    $url = $baseUrl . '/guides/' . $guide;
    $guidesXml .= Util::generateSitemapUrl($url, date('Y-m-d'), 'monthly', 0.7);
}

$guidesXml .= '</urlset>';
file_put_contents(__DIR__ . '/../public/sitemap-guides.xml', $guidesXml);
echo "Created sitemap-guides.xml (" . count($guides) . " URLs)\n";

// Cities sitemap
$citiesXml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$citiesXml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

$services = $matrix->getServices();
$cities = $locations->getAll();

foreach ($services as $service) {
    foreach ($cities as $city) {
        $url = $baseUrl . '/' . $service . '/' . strtolower($city['city']);
        $citiesXml .= Util::generateSitemapUrl($url, date('Y-m-d'), 'monthly', 0.5);
    }
}

$citiesXml .= '</urlset>';
file_put_contents(__DIR__ . '/../public/sitemap-cities.xml', $citiesXml);
echo "Created sitemap-cities.xml (" . (count($services) * count($cities)) . " URLs)\n";

echo "All sitemaps generated successfully!\n";

