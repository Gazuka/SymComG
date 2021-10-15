<?php

namespace App\Repository\Classeur;

use App\Entity\Classeur\EnumClasseurType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EnumClasseurType|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnumClasseurType|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnumClasseurType[]    findAll()
 * @method EnumClasseurType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnumClasseurTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnumClasseurType::class);
    }

    // /**
    //  * @return EnumClasseurType[] Returns an array of EnumClasseurType objects
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
    public function findOneBySomeField($value): ?EnumClasseurType
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