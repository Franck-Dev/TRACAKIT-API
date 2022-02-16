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
        $schemas=$openApi->getComponents()->getSecuritySchemes();
        $schemas['cookieAuth'] = new \ArrayObject([
            'type' => 'apiKey',
            'in' => 'cookie',
            'name' => 'PHPESSID'
        ]);
        $openApi=$openApi->withSecurity(['cookieAuth' => []]);
        //dd($openApi);
        return $openApi;
    }
}
