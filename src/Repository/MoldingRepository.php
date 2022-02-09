<?php

namespace App\Repository;

use App\Entity\Molding;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Molding|null find($id, $lockMode = null, $lockVersion = null)
 * @method Molding|null findOneBy(array $criteria, array $orderBy = null)
 * @method Molding[]    findAll()
 * @method Molding[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MoldingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Molding::class);
    }

    // /**
    //  * @return Molding[] Returns an array of Molding objects
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
    public function findOneBySomeField($value): ?Molding
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
