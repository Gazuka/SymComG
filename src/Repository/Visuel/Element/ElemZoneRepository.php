<?php

namespace App\Repository\Visuel\Element;

use App\Entity\Visuel\Element\ElemZone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ElemZone|null find($id, $lockMode = null, $lockVersion = null)
 * @method ElemZone|null findOneBy(array $criteria, array $orderBy = null)
 * @method ElemZone[]    findAll()
 * @method ElemZone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElemZoneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ElemZone::class);
    }

    // /**
    //  * @return ElemZone[] Returns an array of ElemZone objects
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
    public function findOneBySomeField($value): ?ElemZone
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
