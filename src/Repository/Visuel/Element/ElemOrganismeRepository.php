<?php

namespace App\Repository\Visuel\Element;

use App\Entity\Visuel\Element\ElemOrganisme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ElemOrganisme|null find($id, $lockMode = null, $lockVersion = null)
 * @method ElemOrganisme|null findOneBy(array $criteria, array $orderBy = null)
 * @method ElemOrganisme[]    findAll()
 * @method ElemOrganisme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElemOrganismeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ElemOrganisme::class);
    }

    // /**
    //  * @return ElemOrganisme[] Returns an array of ElemOrganisme objects
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
    public function findOneBySomeField($value): ?ElemOrganisme
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
