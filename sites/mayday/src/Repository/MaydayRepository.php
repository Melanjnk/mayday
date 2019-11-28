<?php

namespace App\Repository;

use App\Entity\Mayday;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Mayday|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mayday|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mayday[]    findAll()
 * @method Mayday[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaydayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mayday::class);
    }

    // /**
    //  * @return Mayday[] Returns an array of Mayday objects
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
    public function findOneBySomeField($value): ?Mayday
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
