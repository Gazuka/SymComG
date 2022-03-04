<?php

namespace App\Repository\Classeur\Format\Pdf;

use App\Entity\Classeur\Format\Pdf\Plaquette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Plaquette|null find($id, $lockMode = null, $lockVersion = null)
 * @method Plaquette|null findOneBy(array $criteria, array $orderBy = null)
 * @method Plaquette[]    findAll()
 * @method Plaquette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaquetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Plaquette::class);
    }

    // /**
    //  * @return Plaquette[] Returns an array of Plaquette objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Plaquette
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
