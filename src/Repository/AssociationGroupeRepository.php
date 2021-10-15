<?php

namespace App\Repository;

use App\Entity\Organisme\AssociationGroupe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssociationGroupe|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssociationGroupe|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssociationGroupe[]    findAll()
 * @method AssociationGroupe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssociationGroupeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssociationGroupe::class);
    }

    // /**
    //  * @return AssociationGroupe[] Returns an array of AssociationGroupe objects
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
    public function findOneBySomeField($value): ?AssociationGroupe
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
