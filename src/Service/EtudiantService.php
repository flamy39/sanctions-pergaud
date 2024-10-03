<?php

namespace App\Service;

use App\Entity\Etudiant;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Entity\Promotion;

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

    public function importFromCsv(UploadedFile $csvFile, Promotion $promotion): int
    {
        $importedCount = 0;
        $handle = fopen($csvFile->getPathname(), 'r');

        if ($handle !== false) {
            // Ignorer la première ligne si elle contient des en-têtes
            fgetcsv($handle);

            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                if (count($data) >= 2) {
                    $prenom = trim($data[0]);
                    $nom = trim($data[1]);

                    $etudiant = new Etudiant();
                    $etudiant->setPrenom($prenom);
                    $etudiant->setNom($nom);
                    $etudiant->setPromotion($promotion);

                    $this->entityManager->persist($etudiant);
                    $importedCount++;
                }
            }

            fclose($handle);
            $this->entityManager->flush();
        }

        return $importedCount;
    }

    // Autres méthodes...
}