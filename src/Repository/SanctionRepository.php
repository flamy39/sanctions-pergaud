<?php

namespace App\Repository;

use App\Entity\Sanction;
use Doctrine\ORM\EntityRepository;

class SanctionRepository extends EntityRepository {
  
  public function findAllOrderedByDateDesc(): array
  {
      return $this->createQueryBuilder('s')
          ->orderBy('s.date', 'DESC')
          ->getQuery()
          ->getResult();
  }

  public function findRecentSanctions(int $limit): array
  {
      return $this->createQueryBuilder('s')
          ->orderBy('s.date', 'DESC')
          ->setMaxResults($limit)
          ->getQuery()
          ->getResult();
  }

  // ... autres méthodes
}