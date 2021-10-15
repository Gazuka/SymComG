<?php

namespace App\Repository;

use App\Entity\Classeur\Format\Pdf\BulletinMunicipal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BulletinMunicipal|null find($id, $lockMode = null, $lockVersion = null)
 * @method BulletinMunicipal|null findOneBy(array $criteria, array $orderBy = null)
 * @method BulletinMunicipal[]    findAll()
 * @method BulletinMunicipal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BulletinMunicipalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BulletinMunicipal::class);
    }

    // /**
    //  * @return BulletinMunicipal[] Returns an array of BulletinMunicipal objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BulletinMunicipal
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
