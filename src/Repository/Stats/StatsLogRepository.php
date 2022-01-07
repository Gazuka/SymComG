<?php

namespace App\Repository\Stats;

use App\Entity\Stats\StatsLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StatsLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatsLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatsLog[]    findAll()
 * @method StatsLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatsLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatsLog::class);
    }

    // /**
    //  * @return StatsLog[] Returns an array of StatsLog objects
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
    public function findOneBySomeField($value): ?StatsLog
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
