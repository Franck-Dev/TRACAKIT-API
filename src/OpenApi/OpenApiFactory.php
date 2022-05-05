<?php

// src/OpenApi

namespace App\OpenApi;

use ApiPlatform\Core\OpenApi\OpenApi;
use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;

class OpenApiFactory implements OpenApiFactoryInterface
{
    Private $decorated;

    Public function __construct(OpenApiFactoryInterface $decorated) {
        $this->decorated=$decorated;
    }

    /**
     * Creates an OpenApi class.
     */
    public function __invoke(array $context = []): OpenApi{

        $openApi=$this->decorated->__invoke($context);
/*         $schemas=$openApi->getComponents()->getSecuritySchemes();
        $schemas['ApiKeyAuth'] = new \ArrayObject([
            'type' => 'apiKey',
            'in' => 'header',
            'name' => 'X-AUTH-TOKEN'
        ]);
        $openApi=$openApi->withSecurity(['ApiKeyAuth' => []]); */
        //dd($openApi);
        return $openApi;
    }
}
