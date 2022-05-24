<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    
    /**
     * getDatasUsers :  Donne le user connecté ou appelé
     *
     * @param  string $apiToken
     * @return mixed
     */
    public function getDatasUsers($apiToken=null)
    {
        //dd($this->client);
        $response = $this->client->request(
            'GET',
            'http://localhost:84/api/users?page=1&itemsPerPage=1&pagination=true&apiToken='.$apiToken
        );
        $user=$response->toArray();
        if ($user){
            if ($user[0]['isActive'] == true)
            {
                return $user[0];
            } else {
                $data=['message' => 'Utilisateur désactivé'];
                
                return new JsonResponse($data, Response::HTTP_LOCKED);
            }
        } else {
            $data=['message' => 'Utilisateur pas trouvé'];
                
            return new JsonResponse($data, Response::HTTP_NOT_FOUND);
        }
        return $response->toArray();
    }

     /**
     * Fonction permettant de remonter les données des API exter suivant une url
     *
     * @param  string $url
     * @return array
     */
    public function getDatas($url=null, bool $pathAPIExter): array
    {
        //Gestion de la construction de la requete API svt envirronements
        if ($pathAPIExter == false)
        {
            //$path=$_ENV['APP_SERVER'];
        } elseif ($_ENV['APP_ENV'] == 'dev')
        {
            //$path=$_SERVER['SYMFONY_PROJECT_DEFAULT_ROUTE_URL'];
            //$path='http://127.0.0.1:8000/';
        } else {
            //$path='http://localhost:83';
        }
        $response = $this->client->request(
            'GET',
            //$path.$url
            $url
        );
        return $response->toArray();
    }
}