<?php

namespace App\Repository\Architecture;

use App\Entity\Architecture\RouteParam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RouteParam|null find($id, $lockMode = null, $lockVersion = null)
 * @method RouteParam|null findOneBy(array $criteria, array $orderBy = null)
 * @method RouteParam[]    findAll()
 * @method RouteParam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RouteParamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RouteParam::class);
    }

    // /**
    //  * @return RouteParam[] Returns an array of RouteParam objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RouteParam
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
