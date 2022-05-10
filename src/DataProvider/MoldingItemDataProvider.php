<?php
// api/src/DataProvider/MoldingCollectionDataProvider.php

namespace App\DataProvider;

use App\Entity\Molding;
use App\Service\CallApiService;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\DenormalizedIdentifiersAwareItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class MoldingItemDataProvider implements DenormalizedIdentifiersAwareItemDataProviderInterface, RestrictedDataProviderInterface
{
    private $callAPIService;
    private $itemDataProvider;

    public function __construct( CallApiService $callAPIService, ItemDataProviderInterface $itemDataProvider)
    {
        $this->callAPIService=$callAPIService;
        $this->itemDataProvider=$itemDataProvider;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Molding::class === $resourceClass;
    }

    public function getItem(string $resourceClass, /* array */ $id, string $operationName = null, array $context = []): ?Molding
    {
        $item = $this->itemDataProvider->getItem($resourceClass, $id, $operationName, $context);
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
        return $item;
    }
}
