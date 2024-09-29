<?php

namespace App\Controller;

use App\Entity\Promotion;
use App\Repository\PromotionRepository;
use App\Service\PromotionService;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromotionController {
    private PromotionService $promotionService;
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
        $this->promotionService = new PromotionService(
            $this->entityManager->getRepository(Promotion::class),
            $this->entityManager
        );
    }

    /**
     * @Route("/promotions", name="list_promotions")
     */
    public function list(): Response {
        $promotions = $this->promotionService->getAllPromotionsWithStats();
        
        $content = render('promotions/list', [
            'promotions' => $promotions,
        ]);
        
        return new Response($content);
    }

    /**
     * @Route("/promotions/{id}", name="show_promotion")
     */
    public function show(Request $request, int $id): Response {
        $promotion = $this->promotionService->getPromotionById($id);
        
        if (!$promotion) {
            return new Response(render('errors/404'), Response::HTTP_NOT_FOUND);
        }
        
        $totalSanctions = $this->promotionService->getTotalSanctionsForPromotion($promotion);
        
        $content = render('promotions/detail', [
            'promotion' => $promotion,
            'totalSanctions' => $totalSanctions,
        ]);
        
        return new Response($content);
    }

    // Autres méthodes...
}