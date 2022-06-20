<?php
// api/src/DataProvider/AdditionalMaterialCollectionDataProvider.php

namespace App\DataProvider;

use App\Entity\AdditionalMaterial;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\AST\NewObjectExpression;
use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;

final class AdditionalMaterialCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $collectionDataProvider;
    private $managerRegistry;

    public function __construct(CollectionDataProviderInterface $collectionDataProvider, ManagerRegistry $managerRegistry)
    {
        $this->collectionDataProvider = $collectionDataProvider;
        $this->managerRegistry = $managerRegistry;
    }
    
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return AdditionalMaterial::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        // Récupération des données de tous les Controles
        if (array_key_exists('outillageMoulage',$context['filters'])==true){
            $manager = $this->managerRegistry->getManagerForClass($resourceClass);
            $repository = $manager->getRepository($resourceClass);
            //On récupère les différents types de matériaux à ajouter à l'outillage, + les références
            $types=$repository->findByType($context['filters']['outillageMoulage']);
            foreach ($types as $type) {
                $datas[$type['designation']]=$repository->findByOutillage($context['filters']['outillageMoulage'],$type);
            }
        } else {
            $datas= $this->collectionDataProvider->getCollection($resourceClass, $operationName, $context);
        }
        
        return $datas;
    }
}
