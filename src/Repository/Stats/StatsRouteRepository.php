<?php

namespace App\Repository\Stats;

use App\Entity\Stats\StatsRoute;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StatsRoute|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatsRoute|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatsRoute[]    findAll()
 * @method StatsRoute[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatsRouteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatsRoute::class);
    }

    // /**
    //  * @return StatsRoute[] Returns an array of StatsRoute objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StatsRoute
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
