<?php

namespace App\Service;

use App\Entity\Etudiant;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\EntityManagerInterface;

class EtudiantService {
    private EtudiantRepository $etudiantRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(EtudiantRepository $etudiantRepository, EntityManagerInterface $entityManager) {
        $this->etudiantRepository = $etudiantRepository;
        $this->entityManager = $entityManager;
    }

    public function getAllEtudiants(): array {
        return $this->etudiantRepository->findAll();
    }

    public function getEtudiantById($id): ?Etudiant {
        return $this->etudiantRepository->find($id);
    }

    public function getEtudiantsByPromotion($promotionId): array {
        return $this->etudiantRepository->findBy(['promotion' => $promotionId]);
    }

    public function addEtudiant(Etudiant $etudiant): void {
        $this->entityManager->persist($etudiant);
        $this->entityManager->flush();
    }

    public function updateEtudiant(Etudiant $etudiant): void
    {
        $this->entityManager->persist($etudiant);
        $this->entityManager->flush();
    }

    // Autres méthodes...
}