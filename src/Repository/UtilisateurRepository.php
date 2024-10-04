<?php

namespace App\Repository;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityRepository;

class UtilisateurRepository extends EntityRepository
{
    public function findByLogin($login)
    {
        return $this->findOneBy(['login' => $login]);
    }

    public function findByPseudo($pseudo)
    {
        return $this->findOneBy(['pseudo' => $pseudo]);
    }

    public function findAllOrderedByLogin()
    {
        return $this->createQueryBuilder('u')
            ->orderBy('u.login', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByRole($role)
    {
        return $this->createQueryBuilder('u')
            ->where('u.role = :role')
            ->setParameter('role', $role)
            ->getQuery()
            ->getResult();
    }

    public function searchByLoginOrPseudo($searchTerm)
    {
        return $this->createQueryBuilder('u')
            ->where('u.login LIKE :searchTerm')
            ->orWhere('u.pseudo LIKE :searchTerm')
            ->setParameter('searchTerm', '%' . $searchTerm . '%')
            ->getQuery()
            ->getResult();
    }
}