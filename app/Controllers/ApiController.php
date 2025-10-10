<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Faq;

class ApiController extends Controller
{
    private Faq $faq;

    public function __construct()
    {
        parent::__construct();
        $this->faq = new Faq();
    }

    public function faqs(): void
    {
        $query = $_GET['q'] ?? '';
        
        if (empty($query)) {
            $results = $this->faq->getRandom(10);
        } else {
            $results = $this->faq->search($query);
        }
        
        $this->json([
            'success' => true,
            'count' => count($results),
            'faqs' => $results
        ]);
    }
}
