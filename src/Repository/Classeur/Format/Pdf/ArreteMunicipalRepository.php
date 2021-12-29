<?php

namespace App\Repository\Classeur\Format\Pdf;

use App\Entity\Classeur\Format\Pdf\ArreteMunicipal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArreteMunicipal|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArreteMunicipal|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArreteMunicipal[]    findAll()
 * @method ArreteMunicipal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArreteMunicipalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArreteMunicipal::class);
    }

    public function findArretes($limit, $offset = 1)
    {
        return $this->createQueryBuilder('a')            
            ->orderBy('a.date', 'DESC')
            ->setMaxResults($limit)
            ->setFirstResult(($limit * $offset) - $limit)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return ArreteMunicipal[] Returns an array of ArreteMunicipal objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ArreteMunicipal
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
