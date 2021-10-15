<?php

namespace App\Repository;

use App\Entity\Organisme\EnumEntrepriseType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EnumEntrepriseType|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnumEntrepriseType|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnumEntrepriseType[]    findAll()
 * @method EnumEntrepriseType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnumEntrepriseTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnumEntrepriseType::class);
    }

    // /**
    //  * @return EnumEntrepriseType[] Returns an array of EnumEntrepriseType objects
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
    public function findOneBySomeField($value): ?EnumEntrepriseType
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
