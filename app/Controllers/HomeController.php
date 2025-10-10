<?php
namespace App\Controllers;
use App\Core\View;

class HomeController {
  public function __construct(private View $view){}
  public function index(): string {
    // In production, load from /data/cities_fl.json and faqs_florida.json
    $cities = [
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
    ];
    $topFaqs = [
      ['q'=>'Do ceramic coatings stop lovebug etching?','a'=>'They reduce sticking and make removal easier; prompt cleaning still matters.'],
      ['q'=>'Will I still get water spots?','a'=>'Minerals can still spot the coating; dry promptly and use SiO2 toppers.'],
      ['q'=>'Indoor application?','a'=>'Recommended in Florida heat/humidity; a controlled bay reduces defects.'],
    ];
    return $this->view->render('home', ['cities'=>$cities, 'topFaqs'=>$topFaqs]);
  }
}