<?php

namespace App\Repository;

use App\Entity\Decks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Decks|null find($id, $lockMode = null, $lockVersion = null)
 * @method Decks|null findOneBy(array $criteria, array $orderBy = null)
 * @method Decks[]    findAll()
 * @method Decks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DecksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Decks::class);
    }

    // /**
    //  * @return Decks[] Returns an array of Decks objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Decks
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
