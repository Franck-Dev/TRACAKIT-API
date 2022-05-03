<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getDatasUsers($apiToken=null): array
    {
        //dd($this->client);
        $response = $this->client->request(
            'GET',
            'http://localhost:8000/api/users'
        );
        if ($apiToken){
            foreach ($response->toArray() as $user) {
                if ($user['apiToken'] == $apiToken)
                {
                    return $user;
                }
            }
        }
        return $response->toArray();
    }
}