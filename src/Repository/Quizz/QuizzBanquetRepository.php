<?php

namespace App\Repository\Quizz;

use App\Entity\Quizz\QuizzBanquet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuizzBanquet|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuizzBanquet|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuizzBanquet[]    findAll()
 * @method QuizzBanquet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizzBanquetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuizzBanquet::class);
    }

    // /**
    //  * @return QuizzBanquet[] Returns an array of QuizzBanquet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuizzBanquet
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
