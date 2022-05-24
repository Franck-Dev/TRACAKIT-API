<?php

// src/Security/ApiKeyAuthenticator.php
namespace App\Security;

use App\Entity\User;
use DateTimeImmutable;
use App\Service\CallApiService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Exception\LockedException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

class ApiKeyAuthenticator extends AbstractAuthenticator
{
    private $CallApi;

    public function __construct(CallApiService $CallApi)
    {
        $this->CallApi = $CallApi;
    }
    
    /**
     * Called on every request to decide if this authenticator should be
     * used for the request. Returning `false` will cause this authenticator
     * to be skipped.
     */
    public function supports(Request $request): ?bool
    {
        return $request->headers->has('X-AUTH-TOKEN');
    }

    public function authenticate(Request $request): Passport
    {
        $apiToken = $request->headers->get('X-AUTH-TOKEN');
        if (null === $apiToken) {
            // The token header was empty, authentication fails with HTTP Status
            // Code 401 "Unauthorized"
            throw new CustomUserMessageAuthenticationException('No API token provided');
        }

        return new SelfValidatingPassport(new UserBadge($apiToken,function($apiToken){
            $userToken=$this->CallApi->getDatasUsers($apiToken);
            //Gestion des erreurs d'authentification
            if ($userToken instanceof JsonResponse) {
                switch ($userToken->getStatusCode()) {
                    case 423:
                        throw new LockedException();
                        break;
                    case 404:
                        throw new UserNotFoundException();
                        break;
                    default:
                        # code...
                        break;
                }
            }
            $user=new User($userToken);
            //Hydratation du User
            foreach ($userToken as $key => $value) {
                // On créé le nom des setters correspondants
                $method = 'set'.ucfirst($key);
                // On vérifie que le setter correspondant existe
                if (method_exists($user, $method)) {
                    if (is_array($value))
                    {

                    } elseif (count(explode("-",$value))>2) 
                    {
                        $value=new \DateTimeImmutable($value);
                    }
                    // S'il existe, on l'appelle
                    $user->$method($value);
                }
            } 
            return $user;
        }));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $data = [
            // you may want to customize or obfuscate the message first
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())

            // or to translate this message
            // $this->translator->trans($exception->getMessageKey(), $exception->getMessageData())
        ];
        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }
    
    /**
     * getUserIdentifierByToken Donne l'utilisateur suivant son token au travers de l'API Usine
     *
     * @param  string $apiToken
     * @return array
     */
    private function getUserIdentifierByToken($apiToken)
    {
        $users=$this->CallApi->getDatasUsers($apiToken);
        dump($users);
        foreach ($users as $user) {
            if ($user['apiToken'] == $apiToken)
            {
                return new User($user);
            }
        }
    }
}