<?php

namespace App\Repository\Classeur\Format\Pdf;

use App\Entity\Classeur\Format\Pdf\Deliberation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Deliberation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Deliberation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Deliberation[]    findAll()
 * @method Deliberation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeliberationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Deliberation::class);
    }

    // /**
    //  * @return Deliberation[] Returns an array of Deliberation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Deliberation
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
