<?php

namespace App\Repository\Stats;

use App\Entity\Stats\StatsParam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StatsParam|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatsParam|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatsParam[]    findAll()
 * @method StatsParam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatsParamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatsParam::class);
    }

    // /**
    //  * @return StatsParam[] Returns an array of StatsParam objects
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
    public function findOneBySomeField($value): ?StatsParam
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
