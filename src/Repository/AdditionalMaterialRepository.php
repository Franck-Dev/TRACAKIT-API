<?php

namespace App\Repository;

use App\Entity\AdditionalMaterial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AdditionalMaterial|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdditionalMaterial|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdditionalMaterial[]    findAll()
 * @method AdditionalMaterial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdditionalMaterialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdditionalMaterial::class);
    }

    // /**
    //  * @return AdditionalMaterial[] Returns an array of AdditionalMaterial objects
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
    public function findOneBySomeField($value): ?AdditionalMaterial
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
