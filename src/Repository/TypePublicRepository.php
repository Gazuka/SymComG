<?php

namespace App\Repository;

use App\Entity\TypePublic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypePublic|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypePublic|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypePublic[]    findAll()
 * @method TypePublic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypePublicRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypePublic::class);
    }

    // /**
    //  * @return TypePublic[] Returns an array of TypePublic objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypePublic
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
