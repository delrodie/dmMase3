<?php

namespace App\Repository;

use App\Entity\Management;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Management>
 */
class ManagementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Management::class);
    }

//    /**
//     * @return Management[] Returns an array of Management objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Management
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
