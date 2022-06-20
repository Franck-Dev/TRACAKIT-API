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
    
    public function findByOutillage($nOT, $type)
    {
        return $this->createQueryBuilder('a')
            ->select('a.ref','a.designation')
            ->join('a.typeMaterial', 'p')
            ->andWhere('a.outillageMoulage = :val')
            ->andWhere('p.designation = :type')
            ->setParameter('val', $nOT)
            ->setParameter('type', $type)
            ->orderBy('a.ref', 'ASC')
            ->groupBy('a.ref')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    
    // /**
    //  * @return AdditionalMaterial[] Returns an array of differents TypeMaterial
    //  */
    public function findByType($nOT)
    {
        return $this->createQueryBuilder('a')
            ->select('p.designation')->distinct(true)
            ->join('a.typeMaterial', 'p')
            ->andWhere('a.outillageMoulage = :val')
            ->setParameter('val', $nOT)
            //->groupBy('a.typeMaterial')
            ->getQuery()
            ->getResult()
            //->getOneOrNullResult()
        ;
    }
    
}
