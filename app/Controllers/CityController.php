<?php
namespace App\Controllers;
use App\Core\View;

class CityController {
  public function __construct(private View $view){}
  public function show(string $service, string $citySlug): string {
    $city = ucwords(str_replace('-', ' ', $citySlug));
    // In production, look up from cities_fl.json
    $meta = ['county'=>'Lee','coastal'=>true,'lat'=>26.6406,'lng'=>-81.8723];
    $tokens = ['lovebugs'=>true,'marine'=>($service==='gelcoat-ceramic')];

    $faqs = [
      ['q'=>'How long will it last in Florida?','a'=>'Up to ~5 years with proper care; heavy sun reduces lifespan.'],
      ['q'=>'Can I wash in direct sun?','a'=>'Avoid; wash in shade and dry promptly to limit spotting.'],
      ['q'=>'Top over PPF?','a'=>'Yes, many owners coat on top of PPF for easier cleaning.'],
    ];

    return $this->view->render('city', [
      'service'=>$service,'city'=>$city,
      'county'=>$meta['county'],'coastal'=>$meta['coastal'],
      'lat'=>$meta['lat'],'lng'=>$meta['lng'],
      'tokens'=>$tokens,'faqs'=>$faqs
    ]);
  }
}