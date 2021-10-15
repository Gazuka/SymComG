<?php

namespace App\Repository;

use App\Entity\Organisme\EnumAssociationType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EnumAssociationType|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnumAssociationType|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnumAssociationType[]    findAll()
 * @method EnumAssociationType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnumAssociationTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnumAssociationType::class);
    }

    // /**
    //  * @return EnumAssociationType[] Returns an array of EnumAssociationType objects
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
    public function findOneBySomeField($value): ?EnumAssociationType
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
