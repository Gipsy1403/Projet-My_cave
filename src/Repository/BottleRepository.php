<?php

namespace App\Repository;

use App\Entity\Bottle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bottle>
 */
class BottleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bottle::class);
    }
// Affichage du bouton par tri ordre alphabétique des noms des domaines
    public function findByOrderAsc(): array
       {
           return $this->createQueryBuilder('b')
               ->orderBy('b.name', 'ASC')
               ->getQuery()
               ->getResult()
           ;
       }
// Affichage du bouton par tri ordre descendant alphabétique des noms des domaines
	  public function findByOrderDesc(): array
       {
           return $this->createQueryBuilder('b')
               ->orderBy('b.name', 'DESC')
               ->getQuery()
               ->getResult()
           ;
       }

	  public function findByYear($year): array
       {
           return $this->createQueryBuilder('b')
               ->orderBy('b.year', 'Millesime')
               ->getQuery()
               ->getResult()
           ;
       }

//    /**
//     * @return Bottle[] Returns an array of Bottle objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Bottle
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
