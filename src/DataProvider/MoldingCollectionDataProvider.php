<?php
// api/src/DataProvider/MoldingCollectionDataProvider.php

namespace App\DataProvider;

use App\Entity\Molding;
use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use App\Service\CallApiService;
use Doctrine\ORM\Query\AST\NewObjectExpression;

final class MoldingCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $collectionDataProvider;
    private $callAPIService;

    public function __construct(CollectionDataProviderInterface $collectionDataProvider, CallApiService $callAPIService)
    {
        $this->collectionDataProvider = $collectionDataProvider;
        $this->callAPIService=$callAPIService;
    }
    
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Molding::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        // Récupération des données de tous les Controles
        $datas= $this->collectionDataProvider->getCollection($resourceClass, $operationName, $context);
        // On ajoute les données user(api-usine) pour le demandeur
        foreach ($datas as $item) {
            if (null === $item) {
                // Pas de Molding trouvé
                // Code 401 "Unauthorized"
                //throw new NotFoundHttpException('No Molding n°'.$id.' was found');
            } else {
                switch ($operationName) {
                    case 'get':
                        $item->setOT($this->callAPIService->getDatas('http://localhost:83'.$item->getOutillage(),false));
                        $item->setUserCreat($this->callAPIService->getDatas('http://localhost:84'.$item->getCreatedBy(),false));
                        if ($item->getModifiedBy())
                        {
                            $item->setUserModif($this->callAPIService->getDatas('http://localhost:84'.$item->getModifiedBy(),false));
                        }
                        break;
                    case 'delete':
                        //Si opération delete on touche à rien
                        break;
                    default:
                        //$item=$item->setDemandeur($this->callAPIService->getDatas($item->getUserCreat(),false));
                        break;
                }
            }
        }
        return $datas;
    }
}
