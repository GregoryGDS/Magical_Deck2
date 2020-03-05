<?php

namespace App\Repository;

use App\Entity\Factions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Factions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Factions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Factions[]    findAll()
 * @method Factions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FactionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Factions::class);
    }

    // /**
    //  * @return Factions[] Returns an array of Factions objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Factions
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
