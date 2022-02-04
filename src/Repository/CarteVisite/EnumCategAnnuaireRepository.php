<?php

namespace App\Repository\CarteVisite;

use App\Entity\CarteVisite\EnumCategAnnuaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EnumCategAnnuaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnumCategAnnuaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnumCategAnnuaire[]    findAll()
 * @method EnumCategAnnuaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnumCategAnnuaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnumCategAnnuaire::class);
    }

    // /**
    //  * @return EnumCategAnnuaire[] Returns an array of EnumCategAnnuaire objects
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
    public function findOneBySomeField($value): ?EnumCategAnnuaire
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
