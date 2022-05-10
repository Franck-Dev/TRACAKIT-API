<?php
// api/src/DataProvider/MoldingCollectionDataProvider.php

namespace App\DataProvider;

use App\Entity\Molding;
use App\Service\CallApiService;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\DenormalizedIdentifiersAwareItemDataProviderInterface;

final class MoldingItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    private $callAPIService;

    public function __construct(CallApiService $callAPIService)
    {
        $this->callAPIService=$callAPIService;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Molding::class === $resourceClass;
    }

    public function getItem(string $resourceClass, /* array */ $id, string $operationName = null, array $context = [])
    {
        $item = $this->itemDataProvider->getItem($resourceClass, $id, $operationName, $context);
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
        if ($resourceClass == Demandes::class)
        {
            
        } else {
            
        }
        return $item;
    }
}
