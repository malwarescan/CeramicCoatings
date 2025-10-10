<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Schema\LocalBusiness;
use App\Schema\WebSite;
use App\Schema\Breadcrumbs;

class GuideController extends Controller
{
    public function show(string $slug): void
    {
        $guides = $this->getGuides();
        
        if (!isset($guides[$slug])) {
            $this->notFound();
            return;
        }

        $guide = $guides[$slug];
        
        $breadcrumbs = [
            ['name' => 'Home', 'url' => '/'],
            ['name' => 'Guides', 'url' => '/guides'],
            ['name' => $guide['title'], 'url' => "/guides/{$slug}"]
        ];

        $this->setData('page_title', $guide['title'] . ' | Florida Ceramic Coating Guide');
        $this->setData('page_description', $guide['description']);
        $this->setData('guide', $guide);
        $this->setData('breadcrumbs', $breadcrumbs);
        
        // JSON-LD Schema
        $this->setData('jsonld', [
            'LocalBusiness' => (new LocalBusiness())->generate(),
            'WebSite' => (new WebSite())->generate(),
            'Breadcrumbs' => (new Breadcrumbs($breadcrumbs))->generate()
        ]);
        
        $this->render('guide');
    }

    private function getGuides(): array
    {
        return [
            'water-spot-removal' => [
                'title' => 'Water Spot Removal on Ceramic Coated Vehicles',
                'description' => 'Learn how to safely remove water spots from ceramic coated vehicles in Florida\'s hard water conditions.',
                'content' => $this->getWaterSpotContent()
            ],
            'wash-routine' => [
                'title' => 'Proper Wash Routine for Ceramic Coatings',
                'description' => 'Step-by-step guide to maintaining ceramic coatings with the right wash routine in Florida.',
                'content' => $this->getWashRoutineContent()
            ],
            'lovebug-season' => [
                'title' => 'Lovebug Season Protection and Cleanup',
                'description' => 'Protect your ceramic coated vehicle during Florida\'s lovebug season with proper prevention and cleanup.',
                'content' => $this->getLovebugContent()
            ],
            'gelcoat-oxidation' => [
                'title' => 'Marine Gelcoat Oxidation Prevention',
                'description' => 'How ceramic coatings help prevent gelcoat oxidation on boats in Florida\'s marine environment.',
                'content' => $this->getGelcoatContent()
            ]
        ];
    }

    private function getWaterSpotContent(): string
    {
        return '
        <h2>Understanding Water Spots on Ceramic Coatings</h2>
        <p>Even with ceramic coatings, water spots can still occur in Florida due to hard water minerals. The coating makes removal easier and prevents etching, but prompt action is essential.</p>
        
        <h3>Prevention Strategies</h3>
        <ul>
            <li>Use pH-balanced shampoos during washing</li>
            <li>Dry vehicles promptly after washing or rain</li>
            <li>Avoid reclaimed water sprinklers when possible</li>
            <li>Apply SiO2 toppers every 2-3 months</li>
        </ul>
        
        <h3>Removal Process</h3>
        <ol>
            <li>Wash vehicle with pH-balanced shampoo</li>
            <li>Apply mineral deposit remover to affected areas</li>
            <li>Let sit for 2-3 minutes</li>
            <li>Gently agitate with microfiber towel</li>
            <li>Rinse thoroughly</li>
            <li>Apply SiO2 topper for added protection</li>
        </ol>
        ';
    }

    private function getWashRoutineContent(): string
    {
        return '
        <h2>Optimal Wash Routine for Florida Conditions</h2>
        <p>Proper maintenance extends ceramic coating life and performance in Florida\'s challenging climate.</p>
        
        <h3>Two-Bucket Method</h3>
        <ol>
            <li>Fill one bucket with pH-balanced shampoo solution</li>
            <li>Fill second bucket with clean rinse water</li>
            <li>Use separate wash mitts for upper and lower sections</li>
            <li>Rinse mitt in clean water between panels</li>
        </ol>
        
        <h3>Drying Process</h3>
        <ul>
            <li>Use clean microfiber drying towels</li>
            <li>Dry immediately after rinsing</li>
            <li>Work in sections to prevent water spots</li>
            <li>Use blower for hard-to-reach areas</li>
        </ul>
        
        <h3>Maintenance Schedule</h3>
        <ul>
            <li>Weekly: Quick rinse and dry</li>
            <li>Bi-weekly: Full two-bucket wash</li>
            <li>Monthly: SiO2 topper application</li>
            <li>Quarterly: Professional inspection</li>
        </ul>
        ';
    }

    private function getLovebugContent(): string
    {
        return '
        <h2>Lovebug Season Protection in Florida</h2>
        <p>Lovebugs peak in spring and fall, especially along I-75 and I-10 corridors. Ceramic coatings make cleanup easier and reduce etching risk.</p>
        
        <h3>Prevention Measures</h3>
        <ul>
            <li>Apply extra SiO2 topper before peak season</li>
            <li>Consider PPF on front surfaces</li>
            <li>Park in garage when possible</li>
            <li>Use bug deflectors on vehicles</li>
        </ul>
        
        <h3>Cleanup Process</h3>
        <ol>
            <li>Remove bugs within 24 hours</li>
            <li>Soak area with bug remover</li>
            <li>Use soft brush or microfiber towel</li>
            <li>Rinse thoroughly</li>
            <li>Apply SiO2 topper to affected area</li>
        </ol>
        
        <h3>Peak Season Timeline</h3>
        <ul>
            <li>Spring: Late April to early June</li>
            <li>Fall: Late August to early October</li>
            <li>Most active: Central and North Florida</li>
        </ul>
        ';
    }

    private function getGelcoatContent(): string
    {
        return '
        <h2>Marine Gelcoat Protection with Ceramic Coatings</h2>
        <p>Ceramic coatings provide superior protection for boat gelcoat against Florida\'s salt air, UV exposure, and oxidation.</p>
        
        <h3>Benefits for Marine Applications</h3>
        <ul>
            <li>Reduces gelcoat oxidation</li>
            <li>Easier salt removal</li>
            <li>Enhanced gloss retention</li>
            <li>Faster hull cleaning</li>
            <li>Protection from UV damage</li>
        </ul>
        
        <h3>Application Considerations</h3>
        <ul>
            <li>Controlled indoor environment required</li>
            <li>Proper surface preparation essential</li>
            <li>Multiple thin coats preferred</li>
            <li>Allow proper curing time</li>
        </ul>
        
        <h3>Maintenance Schedule</h3>
        <ul>
            <li>Weekly: Freshwater rinse after saltwater use</li>
            <li>Monthly: pH-balanced marine wash</li>
            <li>Quarterly: SiO2 topper application</li>
            <li>Annually: Professional inspection and touch-up</li>
        </ul>
        ';
    }

    private function notFound(): void
    {
        http_response_code(404);
        echo "Guide not found";
        exit;
    }
}
