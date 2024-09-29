<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\Professeur;
use App\Entity\Promotion;
use App\Service\EtudiantService;
use App\Service\ProfesseurService;
use App\Service\PromotionService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class EtudiantController {
    private $etudiantService;
    private $promotionService;
    private $entityManager;
    private $professeurService;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
        $this->etudiantService = new EtudiantService(
            $this->entityManager->getRepository(Etudiant::class),
            $this->entityManager
        );
        $this->promotionService = new PromotionService(
            $this->entityManager->getRepository(Promotion::class),
            $this->entityManager
        );
        $this->professeurService = new ProfesseurService(
            $this->entityManager->getRepository(Professeur::class),
            $this->entityManager
        );
    }

    /**
     * @Route("/etudiants", name="list_etudiants")
     */
    public function list(Request $request): Response {
        $promotionId = $request->query->get('promotion');
        
        $promotions = $this->promotionService->getAllPromotions();
        $etudiants = $promotionId 
            ? $this->etudiantService->getEtudiantsByPromotion($promotionId)
            : $this->etudiantService->getAllEtudiants();
        
        $content = render('etudiants/list', [
            'etudiants' => $etudiants,
            'promotions' => $promotions,
            'selectedPromotion' => $promotionId,
        ]);
        
        return new Response($content);
    }

    /**
     * @Route("/etudiants/{id}", name="show_etudiant")
     */
    public function show(Request $request, int $id): Response
    {
        $etudiant = $this->etudiantService->getEtudiantById($id);
        
        if (!$etudiant) {
            // Rediriger vers une page 404 si l'étudiant n'existe pas
            return new Response(render('errors/404'), Response::HTTP_NOT_FOUND);
        }
        
        $professeurs = $this->professeurService->getAllProfesseurs();
        
        $content = render('etudiants/detail', [
            'etudiant' => $etudiant,
            'professeurs' => $professeurs,
        ]);
        
        return new Response($content);
    }

    /**
     * @Route("/etudiants/new", name="new_etudiant", methods={"GET", "POST"})
     */
    public function new(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            // Gestion de la soumission du formulaire
            $nom = $request->request->get('nom');
            $prenom = $request->request->get('prenom');
            $promotionId = $request->request->get('promotion_id');

            $promotion = $this->promotionService->getPromotionById($promotionId);

            if (!$promotion) {
                // Gérer l'erreur si la promotion n'existe pas
                return new Response('Promotion non trouvée', Response::HTTP_BAD_REQUEST);
            }

            $etudiant = new Etudiant();
            $etudiant->setNom($nom);
            $etudiant->setPrenom($prenom);
            $etudiant->setPromotion($promotion);

            $this->etudiantService->addEtudiant($etudiant);

            // Rediriger vers la liste des étudiants après l'ajout
            header('Location: /etudiants');
            exit;
        } else {
            // Afficher le formulaire de saisie du nouvel étudiant
            $promotions = $this->promotionService->getAllPromotions();

            $content = render('etudiants/new', [
                'promotions' => $promotions,
            ]);
            
            return new Response($content);
        }
    }

    // Autres méthodes...

    /**
     * @Route("/etudiants/edit/{id}", name="edit_etudiant", methods={"GET", "POST"})
     */
    public function edit(Request $request, int $id): Response
    {
        $etudiant = $this->etudiantService->getEtudiantById($id);
        
        if (!$etudiant) {
            return new Response(render('errors/404'), Response::HTTP_NOT_FOUND);
        }
        
        if ($request->isMethod('POST')) {
            $prenom = $request->request->get('prenom');
            $nom = $request->request->get('nom');
            $email = $request->request->get('email');
            $promotionId = $request->request->get('promotion_id');
            
            $promotion = $this->promotionService->getPromotionById($promotionId);
            
            if (!$promotion) {
                return new Response('Promotion non trouvée', Response::HTTP_BAD_REQUEST);
            }
            
            $etudiant->setPrenom($prenom);
            $etudiant->setNom($nom);
            $etudiant->setPromotion($promotion);
            
            $this->etudiantService->updateEtudiant($etudiant);
            
            header('Location: /etudiants/' . $etudiant->getId() . '?message=Étudiant modifié avec succès');
            exit;
        }
        
        $promotions = $this->promotionService->getAllPromotions();
        
        $content = render('etudiants/edit', [
            'etudiant' => $etudiant,
            'promotions' => $promotions,
        ]);
        
        return new Response($content);
    }
}