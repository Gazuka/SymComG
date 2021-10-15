<?php

namespace App\Repository\Visuel\Element;

use App\Entity\Visuel\Element\ElemDiapo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ElemDiapo|null find($id, $lockMode = null, $lockVersion = null)
 * @method ElemDiapo|null findOneBy(array $criteria, array $orderBy = null)
 * @method ElemDiapo[]    findAll()
 * @method ElemDiapo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElemDiapoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ElemDiapo::class);
    }

    // /**
    //  * @return ElemDiapo[] Returns an array of ElemDiapo objects
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
    public function findOneBySomeField($value): ?ElemDiapo
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
