<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\Professeur;
use App\Entity\Sanction;
use App\Service\SanctionService;
use App\Service\EtudiantService;
use App\Service\ProfesseurService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

require_once __DIR__ . '/../../config/view.php';

class SanctionController {
    private $sanctionService;
    private $etudiantService;
    private $professeurService;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
        $this->sanctionService = new SanctionService(
            $this->entityManager->getRepository(Sanction::class),
            $this->entityManager
        );
        $this->etudiantService = new EtudiantService(
            $this->entityManager->getRepository(Etudiant::class),
            $this->entityManager
        );
        $this->professeurService = new ProfesseurService(
            $this->entityManager->getRepository(Professeur::class),
            $this->entityManager
        );
    }

    /**
     * @Route("/sanctions/new", name="new_sanction", methods={"GET", "POST"})
     */
    public function new(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            // Gestion de la soumission du formulaire
            $etudiantId = $request->request->get('etudiant_id');
            $professeurId = $request->request->get('professeur_id');
            $date = $request->request->get('date');
            $raison = $request->request->get('raison');
            $description = $request->request->get('description');

            $etudiant = $this->etudiantService->getEtudiantById($etudiantId);
            $professeur = $this->professeurService->getProfesseurById($professeurId);

            if (!$etudiant || !$professeur) {
                // Gérer l'erreur si l'étudiant ou le professeur n'existe pas
                return new Response('Étudiant ou professeur non trouvé', Response::HTTP_BAD_REQUEST);
            }

            $sanction = new Sanction();
            $sanction->setEtudiant($etudiant);
            $sanction->setProfesseur($professeur);
            $sanction->setDate(new \DateTime($date));
            $sanction->setRaison($raison);
            $sanction->setDescription($description);

            $this->sanctionService->addSanction($sanction);

            // Rediriger vers la page des sanctions après l'ajout de la sanction
            header('Location: /sanctions');
            exit;
        } else {
            // Afficher le formulaire de saisie de la nouvelle sanction
            $etudiants = $this->etudiantService->getAllEtudiants();
            $professeurs = $this->professeurService->getAllProfesseurs();

            $content = render('sanctions/new', [
                'etudiants' => $etudiants,
                'professeurs' => $professeurs,
            ]);
            
            return new Response($content);
        }
    }

    /**
     * @Route("/sanctions", name="list_sanctions", methods={"GET"})
     */
    public function list(): Response
    {
        // Récupérer toutes les sanctions ordonnées par date décroissante
        $sanctions = $this->sanctionService->getAllSanctionsOrderedByDateDesc();

        $content = render('sanctions/list', [
            'sanctions' => $sanctions,
        ]);

        return new Response($content);
    }

    /**
     * @Route("/sanctions/{id}", name="show_sanction", methods={"GET"})
     */
    public function show(Request $request, int $id): Response
    {
        $sanction = $this->sanctionService->getSanctionById($id);

        if (!$sanction) {
            return new Response('Sanction non trouvée', Response::HTTP_NOT_FOUND);
        }

        $content = render('sanctions/detail', [
            'sanction' => $sanction,
        ]);

        return new Response($content);
    }

    /**
     * @Route("/sanctions/delete/{id}", name="delete_sanction", methods={"GET"})
     */
    public function delete(Request $request, int $id): Response
    {
        $sanction = $this->sanctionService->getSanctionById($id);

        if (!$sanction) {
            return new Response('Sanction non trouvée', Response::HTTP_NOT_FOUND);
        }

        $this->sanctionService->deleteSanction($sanction);

        // Rediriger vers la liste des sanctions avec un message de succès
        header('Location: /sanctions?message=Sanction supprimée avec succès');
        exit;
    }

    /**
     * @Route("/sanctions/edit/{id}", name="edit_sanction", methods={"GET", "POST"})
     */
    public function edit(Request $request, int $id): Response
    {
        $sanction = $this->sanctionService->getSanctionById($id);
        
        if (!$sanction) {
            return new Response(render('errors/404'), Response::HTTP_NOT_FOUND);
        }
        
        if ($request->isMethod('POST')) {
            $etudiantId = $request->request->get('etudiant_id');
            $professeurId = $request->request->get('professeur_id');
            $date = $request->request->get('date');
            $raison = $request->request->get('raison');
            $description = $request->request->get('description');
            
            $etudiant = $this->etudiantService->getEtudiantById($etudiantId);
            $professeur = $this->professeurService->getProfesseurById($professeurId);
            
            if (!$etudiant || !$professeur) {
                return new Response('Étudiant ou professeur non trouvé', Response::HTTP_BAD_REQUEST);
            }
            
            $sanction->setEtudiant($etudiant);
            $sanction->setProfesseur($professeur);
            $sanction->setDate(new \DateTime($date));
            $sanction->setRaison($raison);
            $sanction->setDescription($description);
            
            $this->sanctionService->updateSanction($sanction);
            
            header('Location: /sanctions/' . $sanction->getId() . '?message=Sanction modifiée avec succès');
            exit;
        }
        
        $etudiants = $this->etudiantService->getAllEtudiants();
        $professeurs = $this->professeurService->getAllProfesseurs();
        
        $content = render('sanctions/edit', [
            'sanction' => $sanction,
            'etudiants' => $etudiants,
            'professeurs' => $professeurs,
        ]);
        
        return new Response($content);
    }

}