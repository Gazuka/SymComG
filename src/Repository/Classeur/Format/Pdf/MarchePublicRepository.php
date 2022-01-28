<?php

namespace App\Repository\Classeur\Format\Pdf;

use DateTime;
use App\Entity\Classeur\Format\Pdf\MarchePublic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MarchePublic|null find($id, $lockMode = null, $lockVersion = null)
 * @method MarchePublic|null findOneBy(array $criteria, array $orderBy = null)
 * @method MarchePublic[]    findAll()
 * @method MarchePublic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarchePublicRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MarchePublic::class);
    }

    public function findMarches($limit, $offset = 1)
    {
        $now = new DateTime();
        $now->setTime(0,0,0,0); // Définir l'heure actuelle a 0h00 afin d'avoir tous les évènements du jour
        return $this->createQueryBuilder('m')   
            ->setParameter('date', $now)
            ->Where('m.datedebut <= :date and m.datefin >= :date')         
            ->orderBy('m.datedebut', 'DESC')
            ->setMaxResults($limit)
            ->setFirstResult(($limit * $offset) - $limit)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return MarchePublic[] Returns an array of MarchePublic objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MarchePublic
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
