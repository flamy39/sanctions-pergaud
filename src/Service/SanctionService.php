<?php

namespace App\Service;

use App\Entity\Sanction;
use App\Repository\SanctionRepository;
use Doctrine\ORM\EntityManagerInterface;

class SanctionService {
    private SanctionRepository $sanctionRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(SanctionRepository $sanctionRepository, EntityManagerInterface $entityManager) {
        $this->sanctionRepository = $sanctionRepository;
        $this->entityManager = $entityManager;
    }

    public function addSanction(Sanction $sanction): void {
        $this->entityManager->persist($sanction);
        $this->entityManager->flush();
    }

    public function getAllSanctionsOrderedByDateDesc(): array {
        return $this->sanctionRepository->findAllOrderedByDateDesc();
    }

    public function getSanctionById(int $id): ?Sanction
    {
        return $this->sanctionRepository->find($id);
    }

    public function deleteSanction(Sanction $sanction): void
    {
        $this->entityManager->remove($sanction);
        $this->entityManager->flush();
    }

    public function updateSanction(Sanction $sanction): void
    {
        $this->entityManager->persist($sanction);
        $this->entityManager->flush();
    }

    public function getRecentSanctions(int $limit): array
    {
        return $this->sanctionRepository->findRecentSanctions($limit);
    }

    // Autres méthodes...
}