<?php

namespace App\Repository\Visuel;

use App\Entity\Visuel\ElemX;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ElemX|null find($id, $lockMode = null, $lockVersion = null)
 * @method ElemX|null findOneBy(array $criteria, array $orderBy = null)
 * @method ElemX[]    findAll()
 * @method ElemX[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElemXRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ElemX::class);
    }

    // /**
    //  * @return ElemX[] Returns an array of ElemX objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ElemX
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
