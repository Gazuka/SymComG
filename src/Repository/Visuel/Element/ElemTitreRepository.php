<?php

namespace App\Repository\Visuel\Element;

use App\Entity\Visuel\Element\ElemTitre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ElemTitre|null find($id, $lockMode = null, $lockVersion = null)
 * @method ElemTitre|null findOneBy(array $criteria, array $orderBy = null)
 * @method ElemTitre[]    findAll()
 * @method ElemTitre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElemTitreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ElemTitre::class);
    }

    // /**
    //  * @return ElemTitre[] Returns an array of ElemTitre objects
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
    public function findOneBySomeField($value): ?ElemTitre
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
