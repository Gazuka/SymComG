<?php

namespace App\Repository\Agenda;

use DateTime;
use App\Entity\Agenda\Evenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Evenement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evenement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evenement[]    findAll()
 * @method Evenement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evenement::class);
    }

    public function findProchains($limit, $offset = 1)
    {
        return $this->createQueryBuilder('e')
            ->setParameter('date', new DateTime())
            ->Where('e.date > :date or e.dateFin > :date')
            ->orderBy('e.date', 'ASC')
            ->setMaxResults($limit)
            ->setFirstResult(($limit * $offset) - $limit)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findProchainsOrganisme($idorganisateur, $limit, $offset = 1)
    {
        return $this->createQueryBuilder('e')
            ->innerJoin('e.organisateurs', 'organisme')
            ->setParameter('date', new DateTime())
            ->setParameter('idorganisateur', $idorganisateur)
            ->Where('e.date > :date or e.dateFin > :date')
            ->AndWhere('organisme.id = :idorganisateur')
            ->orderBy('e.date', 'ASC')
            ->setMaxResults($limit)
            ->setFirstResult(($limit * $offset) - $limit)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findPrincipaux()
    {
        return $this->createQueryBuilder('e')
            ->setParameter('date', new DateTime())
            ->Where('e.date > :date or e.dateFin > :date')
            ->AndWhere('e.majeur = true')
            ->orderBy('e.date', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findPrincipauxOrganisme($idorganisateur)
    {
        return $this->createQueryBuilder('e')
            ->innerJoin('e.organisateurs', 'organisme')
            ->setParameter('date', new DateTime())
            ->setParameter('idorganisateur', $idorganisateur)
            ->Where('e.date > :date or e.dateFin > :date')
            ->AndWhere('organisme.id = :idorganisateur')
            ->AndWhere('e.majeur = true')
            ->orderBy('e.date', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Evenement[] Returns an array of Evenement objects
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
    public function findOneBySomeField($value): ?Evenement
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
