<?php

namespace App\Service;

use App\Entity\Promotion;
use App\Repository\PromotionRepository;
use Doctrine\ORM\EntityManagerInterface;

class PromotionService {
    private PromotionRepository $promotionRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(PromotionRepository $promotionRepository, EntityManagerInterface $entityManager) {
        $this->promotionRepository = $promotionRepository;
        $this->entityManager = $entityManager;
    }

    public function getAllPromotions(): array {
        return $this->promotionRepository->findAll();
    }

    public function getAllPromotionsWithStats(): array {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('p.id, p.nom, p.annee, COUNT(DISTINCT e.id) as nbEtudiants, COUNT(s.id) as nbSanctions')
           ->from(Promotion::class, 'p')
           ->leftJoin('p.etudiants', 'e')
           ->leftJoin('e.sanctions', 's')
           ->groupBy('p.id')
           ->orderBy('p.annee', 'DESC');

        return $qb->getQuery()->getResult();
    }

    public function getPromotionById(int $id): ?Promotion {
        return $this->promotionRepository->find($id);
    }

    public function getTotalSanctionsForPromotion(Promotion $promotion): int {
        $totalSanctions = 0;
        foreach ($promotion->getEtudiants() as $etudiant) {
            $totalSanctions += count($etudiant->getSanctions());
        }
        return $totalSanctions;
    }

    // Autres méthodes si nécessaire...
}