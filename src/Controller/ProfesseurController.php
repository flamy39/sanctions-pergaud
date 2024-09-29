<?php

namespace App\Controller;

use App\Service\ProfesseurService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfesseurController {
    private $professeurService;

    public function __construct(ProfesseurService $professeurService) {
        $this->professeurService = $professeurService;
    }

    /**
     * @Route("/professeurs", name="list_professeurs")
     */
    public function list(): Response {
        // Logique pour lister les professeurs
    }

    // Autres méthodes
}