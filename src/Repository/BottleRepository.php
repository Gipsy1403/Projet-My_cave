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

    public function findByOrderAsc($value): array
       {
           return $this->createQueryBuilder('b')
               ->orderBy('b.name', 'ASC')
               ->getQuery()
               ->getResult()
           ;
       }
	
	  public function findByOrderDesc($value): array
       {
           return $this->createQueryBuilder('b')
               ->orderBy('b.name', 'DESC')
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
