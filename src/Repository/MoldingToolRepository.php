<?php

namespace App\Repository;

use App\Entity\MoldingTool;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MoldingTool|null find($id, $lockMode = null, $lockVersion = null)
 * @method MoldingTool|null findOneBy(array $criteria, array $orderBy = null)
 * @method MoldingTool[]    findAll()
 * @method MoldingTool[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MoldingToolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MoldingTool::class);
    }

    // /**
    //  * @return MoldingTools[] Returns an array of MoldingTools objects
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
    public function findOneBySomeField($value): ?MoldingTools
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
