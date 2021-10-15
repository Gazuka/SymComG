<?php

namespace App\Repository\Menu;

use App\Entity\Menu\Chemin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Chemin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chemin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chemin[]    findAll()
 * @method Chemin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CheminRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chemin::class);
    }

    // /**
    //  * @return Chemin[] Returns an array of Chemin objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Chemin
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
