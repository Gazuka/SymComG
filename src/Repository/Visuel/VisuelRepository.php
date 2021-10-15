<?php

namespace App\Repository\Visuel;

use App\Entity\Visuel\Visuel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Visuel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Visuel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Visuel[]    findAll()
 * @method Visuel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisuelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visuel::class);
    }

    // /**
    //  * @return Visuel[] Returns an array of Visuel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Visuel
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
