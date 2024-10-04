<?php

namespace App\Service;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;

class UtilisateurService
{
    private $utilisateurRepository;
    private $entityManager;

    public function __construct(UtilisateurRepository $utilisateurRepository, EntityManagerInterface $entityManager)
    {
        $this->utilisateurRepository = $utilisateurRepository;
        $this->entityManager = $entityManager;
    }

    public function createUser(string $login, string $password, string $pseudo, string $role = 'ROLE_UTIL'): ?Utilisateur
    {
        // Vérifier si l'utilisateur existe déjà
        if ($this->utilisateurRepository->findOneBy(['login' => $login]) || $this->utilisateurRepository->findOneBy(['pseudo' => $pseudo])) {
            return null; // L'utilisateur existe déjà
        }

        $user = new Utilisateur();
        $user->setLogin($login);
        $user->setPassword($password); // Le hachage est géré dans l'entité
        $user->setPseudo($pseudo);
        $user->setRole($role);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    public function authenticate(string $login, string $password): ?Utilisateur
    {
        $user = $this->utilisateurRepository->findOneBy(['login' => $login]);

        if ($user && password_verify($password, $user->getPassword())) {
            return $user;
        }

        return null;
    }

    public function getUserById(int $id): ?Utilisateur
    {
        return $this->utilisateurRepository->find($id);
    }

    public function updateUser(Utilisateur $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function deleteUser(Utilisateur $user): void
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    public function getAllUsers(): array
    {
        return $this->utilisateurRepository->findAll();
    }
}