<?php

namespace App\Service;

use App\Repository\ProfesseurRepository;

class ProfesseurService {
    private ProfesseurRepository $professeurRepository;

    public function __construct(ProfesseurRepository $professeurRepository) {
        $this->professeurRepository = $professeurRepository;
    }

    public function getAllProfesseurs() {
        return $this->professeurRepository->findAll();
    }

    public function getProfesseurById($id) {
        return $this->professeurRepository->find($id);
    }

    // Méthodes pour gérer les professeurs
}