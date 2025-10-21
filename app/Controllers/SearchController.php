<?php
namespace App\Controllers;
use App\Core\View;

class SearchController {
  public function __construct(private View $view){}
  
  public function index(): string {
    $query = $_GET['q'] ?? '';
    $results = [];
    
    if (!empty($query)) {
      $results = $this->searchContent($query);
    }
    
    return $this->view->render('search', [
      'query' => $query,
      'results' => $results
    ]);
  }
  
  private function searchContent(string $query): array {
    $results = [];
    $query = strtolower(trim($query));
    
    if (empty($query)) {
      return $results;
    }
    
    // Search cities
    $cities = $this->getCities();
    foreach ($cities as $city) {
      $cityName = strtolower($city['city']);
      $countyName = strtolower($city['county']);
      
      if (strpos($cityName, $query) !== false || strpos($countyName, $query) !== false) {
        $results[] = [
          'type' => 'city',
          'title' => $city['city'] . ', FL',
          'description' => $city['county'] . ' County' . ($city['coastal'] ? ' • Coastal' : ''),
          'url' => '/ceramic-coating/' . urlencode(strtolower(str_replace(' ', '-', $city['city']))),
          'relevance' => $this->calculateRelevance($cityName, $query)
        ];
      }
    }
    
    // Search services
    $services = [
      'ceramic-coating' => 'Ceramic Coating',
      'coating-maintenance' => 'Coating Maintenance', 
      'water-spot-removal' => 'Water Spot Removal',
      'gelcoat-ceramic' => 'Gelcoat Ceramic'
    ];
    
    foreach ($services as $slug => $name) {
      $serviceName = strtolower($name);
      if (strpos($serviceName, $query) !== false || strpos($slug, $query) !== false) {
        $results[] = [
          'type' => 'service',
          'title' => $name,
          'description' => 'Professional ' . strtolower($name) . ' services in Florida',
          'url' => '/' . $slug . '/fl',
          'relevance' => $this->calculateRelevance($serviceName, $query)
        ];
      }
    }
    
    // Search FAQs
    $faqs = $this->getFaqs();
    foreach ($faqs as $faq) {
      $question = strtolower($faq['q']);
      $answer = strtolower($faq['a']);
      
      if (strpos($question, $query) !== false || strpos($answer, $query) !== false) {
        $results[] = [
          'type' => 'faq',
          'title' => $faq['q'],
          'description' => substr($faq['a'], 0, 100) . '...',
          'url' => '/#faq-heading',
          'relevance' => $this->calculateRelevance($question . ' ' . $answer, $query)
        ];
      }
    }
    
    // Sort by relevance
    usort($results, function($a, $b) {
      return $b['relevance'] <=> $a['relevance'];
    });
    
    return array_slice($results, 0, 20); // Limit to 20 results
  }
  
  private function calculateRelevance(string $text, string $query): int {
    $score = 0;
    
    // Exact match gets highest score
    if ($text === $query) {
      $score += 100;
    }
    
    // Starts with query gets high score
    if (strpos($text, $query) === 0) {
      $score += 50;
    }
    
    // Contains query gets medium score
    if (strpos($text, $query) !== false) {
      $score += 25;
    }
    
    // Word boundary matches get bonus
    if (preg_match('/\b' . preg_quote($query, '/') . '\b/i', $text)) {
      $score += 15;
    }
    
    return $score;
  }
  
  private function getCities(): array {
    return [
      ['city'=>'Miami','county'=>'Miami-Dade','coastal'=>true],
      ['city'=>'Tampa','county'=>'Hillsborough','coastal'=>true],
      ['city'=>'Orlando','county'=>'Orange','coastal'=>false],
      ['city'=>'Jacksonville','county'=>'Duval','coastal'=>true],
      ['city'=>'Naples','county'=>'Collier','coastal'=>true],
      ['city'=>'Fort Myers','county'=>'Lee','coastal'=>true],
      ['city'=>'Sarasota','county'=>'Sarasota','coastal'=>true],
      ['city'=>'Daytona Beach','county'=>'Volusia','coastal'=>true],
      ['city'=>'Key West','county'=>'Monroe','coastal'=>true],
      ['city'=>'Pensacola','county'=>'Escambia','coastal'=>true],
      ['city'=>'Gainesville','county'=>'Alachua','coastal'=>false],
      ['city'=>'Cape Coral','county'=>'Lee','coastal'=>true],
      ['city'=>'Tallahassee','county'=>'Leon','coastal'=>false],
      ['city'=>'Fort Lauderdale','county'=>'Broward','coastal'=>true],
      ['city'=>'West Palm Beach','county'=>'Palm Beach','coastal'=>true],
      ['city'=>'Clearwater','county'=>'Pinellas','coastal'=>true],
      ['city'=>'St. Petersburg','county'=>'Pinellas','coastal'=>true],
      ['city'=>'Hialeah','county'=>'Miami-Dade','coastal'=>false],
      ['city'=>'Port St. Lucie','county'=>'St. Lucie','coastal'=>true],
      ['city'=>'Coral Springs','county'=>'Broward','coastal'=>false],
      ['city'=>'Gainesville','county'=>'Alachua','coastal'=>false],
      ['city'=>'Miramar','county'=>'Broward','coastal'=>false],
      ['city'=>'Hollywood','county'=>'Broward','coastal'=>true],
      ['city'=>'Pembroke Pines','county'=>'Broward','coastal'=>false],
      ['city'=>'Plantation','county'=>'Broward','coastal'=>false],
      ['city'=>'Davie','county'=>'Broward','coastal'=>false],
      ['city'=>'Sunrise','county'=>'Broward','coastal'=>false],
      ['city'=>'Boca Raton','county'=>'Palm Beach','coastal'=>true],
      ['city'=>'Delray Beach','county'=>'Palm Beach','coastal'=>true],
      ['city'=>'Boynton Beach','county'=>'Palm Beach','coastal'=>true],
      ['city'=>'Lake Worth','county'=>'Palm Beach','coastal'=>true],
      ['city'=>'Wellington','county'=>'Palm Beach','coastal'=>false],
      ['city'=>'Jupiter','county'=>'Palm Beach','coastal'=>true],
      ['city'=>'Palm Beach Gardens','county'=>'Palm Beach','coastal'=>true],
      ['city'=>'Royal Palm Beach','county'=>'Palm Beach','coastal'=>false],
      ['city'=>'Greenacres','county'=>'Palm Beach','coastal'=>false],
      ['city'=>'Lantana','county'=>'Palm Beach','coastal'=>true],
      ['city'=>'Tequesta','county'=>'Palm Beach','coastal'=>true],
      ['city'=>'Hypoluxo','county'=>'Palm Beach','coastal'=>true],
      ['city'=>'Manalapan','county'=>'Palm Beach','coastal'=>true],
      ['city'=>'Ocean Ridge','county'=>'Palm Beach','coastal'=>true],
      ['city'=>'Briny Breezes','county'=>'Palm Beach','coastal'=>true],
      ['city'=>'Gulf Stream','county'=>'Palm Beach','coastal'=>true],
      ['city'=>'Highland Beach','county'=>'Palm Beach','coastal'=>true],
      ['city'=>'South Palm Beach','county'=>'Palm Beach','coastal'=>true],
      ['city'=>'Lighthouse Point','county'=>'Broward','coastal'=>true],
      ['city'=>'Deerfield Beach','county'=>'Broward','coastal'=>true],
      ['city'=>'Pompano Beach','county'=>'Broward','coastal'=>true],
      ['city'=>'Lauderdale Lakes','county'=>'Broward','coastal'=>false],
      ['city'=>'Lauderhill','county'=>'Broward','coastal'=>false],
      ['city'=>'Oakland Park','county'=>'Broward','coastal'=>false],
      ['city'=>'Wilton Manors','county'=>'Broward','coastal'=>false],
      ['city'=>'Fort Lauderdale','county'=>'Broward','coastal'=>true],
      ['city'=>'Dania Beach','county'=>'Broward','coastal'=>true],
      ['city'=>'Hallandale Beach','county'=>'Broward','coastal'=>true],
      ['city'=>'Aventura','county'=>'Miami-Dade','coastal'=>false],
      ['city'=>'Sunny Isles Beach','county'=>'Miami-Dade','coastal'=>true],
      ['city'=>'Bal Harbour','county'=>'Miami-Dade','coastal'=>true],
      ['city'=>'Bay Harbor Islands','county'=>'Miami-Dade','coastal'=>true],
      ['city'=>'Surfside','county'=>'Miami-Dade','coastal'=>true],
      ['city'=>'Miami Beach','county'=>'Miami-Dade','coastal'=>true],
      ['city'=>'North Bay Village','county'=>'Miami-Dade','coastal'=>true],
      ['city'=>'Key Biscayne','county'=>'Miami-Dade','coastal'=>true],
      ['city'=>'Coral Gables','county'=>'Miami-Dade','coastal'=>false],
      ['city'=>'South Miami','county'=>'Miami-Dade','coastal'=>false],
      ['city'=>'Pinecrest','county'=>'Miami-Dade','coastal'=>false],
      ['city'=>'Palmetto Bay','county'=>'Miami-Dade','coastal'=>false],
      ['city'=>'Cutler Bay','county'=>'Miami-Dade','coastal'=>false],
      ['city'=>'Homestead','county'=>'Miami-Dade','coastal'=>false],
      ['city'=>'Florida City','county'=>'Miami-Dade','coastal'=>false],
      ['city'=>'Sweetwater','county'=>'Miami-Dade','coastal'=>false],
      ['city'=>'West Miami','county'=>'Miami-Dade','coastal'=>false],
      ['city'=>'Doral','county'=>'Miami-Dade','coastal'=>false],
      ['city'=>'Medley','county'=>'Miami-Dade','coastal'=>false],
      ['city'=>'Hialeah Gardens','county'=>'Miami-Dade','coastal'=>false],
      ['city'=>'Miami Lakes','county'=>'Miami-Dade','coastal'=>false],
      ['city'=>'Miami Springs','county'=>'Miami-Dade','coastal'=>false],
      ['city'=>'Virginia Gardens','county'=>'Miami-Dade','coastal'=>false],
      ['city'=>'El Portal','county'=>'Miami-Dade','coastal'=>false],
      ['city'=>'North Miami','county'=>'Miami-Dade','coastal'=>false],
      ['city'=>'North Miami Beach','county'=>'Miami-Dade','coastal'=>false],
      ['city'=>'Opa-locka','county'=>'Miami-Dade','coastal'=>false],
      ['city'=>'Miami Gardens','county'=>'Miami-Dade','coastal'=>false],
      ['city'=>'Aventura','county'=>'Miami-Dade','coastal'=>false],
      ['city'=>'Golden Beach','county'=>'Miami-Dade','coastal'=>true],
      ['city'=>'Indian Creek','county'=>'Miami-Dade','coastal'=>true],
      ['city'=>'Fisher Island','county'=>'Miami-Dade','coastal'=>true],
      ['city'=>'Virginia Key','county'=>'Miami-Dade','coastal'=>true],
      ['city'=>'Key Largo','county'=>'Monroe','coastal'=>true],
      ['city'=>'Islamorada','county'=>'Monroe','coastal'=>true],
      ['city'=>'Marathon','county'=>'Monroe','coastal'=>true],
      ['city'=>'Big Pine Key','county'=>'Monroe','coastal'=>true],
      ['city'=>'Summerland Key','county'=>'Monroe','coastal'=>true],
      ['city'=>'Cudjoe Key','county'=>'Monroe','coastal'=>true],
      ['city'=>'Sugarloaf Key','county'=>'Monroe','coastal'=>true],
      ['city'=>'Stock Island','county'=>'Monroe','coastal'=>true],
      ['city'=>'Key West','county'=>'Monroe','coastal'=>true],
      ['city'=>'Dry Tortugas','county'=>'Monroe','coastal'=>true]
    ];
  }
  
  private function getFaqs(): array {
    return [
      ['q'=>'Do ceramic coatings stop lovebug etching?','a'=>'They reduce sticking and make removal easier; prompt cleaning still matters.'],
      ['q'=>'Will I still get water spots?','a'=>'Minerals can still spot the coating; dry promptly and use SiO2 toppers.'],
      ['q'=>'Indoor application?','a'=>'Recommended in Florida heat/humidity; a controlled bay reduces defects.'],
      ['q'=>'How long will it last in Florida?','a'=>'Up to ~5 years with proper care; heavy sun reduces lifespan.'],
      ['q'=>'Can I wash in direct sun?','a'=>'Avoid; wash in shade and dry promptly to limit spotting.'],
      ['q'=>'Top over PPF?','a'=>'Yes, many owners coat on top of PPF for easier cleaning.'],
      ['q'=>'What about salt air damage?','a'=>'Coatings resist salt better than wax; rinse after beach trips.'],
      ['q'=>'Lovebug season preparation?','a'=>'Apply before peak season; easier cleanup during infestation.'],
      ['q'=>'UV protection level?','a'=>'Better than wax; still need garage parking for maximum protection.'],
      ['q'=>'Marine application?','a'=>'Works on gelcoat; reduces oxidation and eases cleaning.'],
      ['q'=>'Cost comparison?','a'=>'Higher upfront than wax; longer protection justifies cost.'],
      ['q'=>'DIY vs professional?','a'=>'Professional recommended; proper prep affects longevity.'],
      ['q'=>'Maintenance schedule?','a'=>'pH-safe wash every 2-3 weeks; SiO2 topper every 2-3 months.'],
      ['q'=>'Warranty coverage?','a'=>'Most offer 2-5 years; proper maintenance required.'],
      ['q'=>'Paint correction needed?','a'=>'Often required; coating amplifies existing defects.'],
      ['q'=>'Ceramic vs graphene?','a'=>'Both work; ceramic more established, graphene newer technology.'],
      ['q'=>'Coating thickness?','a'=>'Measured in microns; thicker doesn\'t always mean better.'],
      ['q'=>'Curing time?','a'=>'24-48 hours in Florida humidity; avoid water exposure.'],
      ['q'=>'Temperature limits?','a'=>'Avoid application below 50°F or above 90°F.'],
      ['q'=>'Humidity concerns?','a'=>'High humidity slows curing; indoor application preferred.']
    ];
  }
}
