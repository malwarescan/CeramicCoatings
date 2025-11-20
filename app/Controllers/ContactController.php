<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;

class ContactController extends Controller {
    public function __construct(View $view) {
        $this->view = $view;
    }

    public function index(): string {
        return $this->view->render('contact', [
            'title' => 'Contact Us | Ceramic Coatings Naples',
            'metaDesc' => 'Contact Ceramic Coatings Naples for a quote on ceramic coating, paint correction, or marine protection services.'
        ]);
    }
}
