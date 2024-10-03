<?php

namespace App\Controller;

use App\Entity\Sanction;
use App\Service\SanctionService;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    private EntityManager $entityManager;
    private SanctionService $sanctionService;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->sanctionService = new SanctionService($this->entityManager->getRepository(Sanction::class), $this->entityManager);
    }

    public function index(): Response
    {
        $recentSanctions = $this->sanctionService->getRecentSanctions(5);

        $content = render('home', [
            'recentSanctions' => $recentSanctions,
        ]);

        return new Response($content);
    }
}