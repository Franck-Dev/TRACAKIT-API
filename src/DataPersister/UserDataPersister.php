<?php

// src/DataPersister

namespace App\DataPersister;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $_entityManager;
    
    /**
     * encoder
     *
     * @var UserPasswordHasherInterface
     */
    private $_encoder;

    public function __construct(
        EntityManagerInterface $entityManager, UserPasswordHasherInterface $encoder
    )
    {
        $this->_entityManager = $entityManager;
        $this->_encoder = $encoder;
    }

    /**
     * {@inheritdoc}
     */
    
    public function supports($data, array $context = []): bool
    {
        return $data instanceof User;
    }

    public function persist($data, array $context = [])
    {
        // Si création on renvoie la date de création, sinon la date de modification
        if ($data->getCreatedAt()) {
            $data->setUpdatedAt(new \DateTimeImmutable());
        } else {
            $data->setCreatedAt(new \DateTimeImmutable());
            $data->setIsActive(true);
            //Si pas de mot de passe, c'est un opérateur et le mot de passe est son matricule
            if (!$data->getPassword()) {
                $hash=$this->_encoder->hashPassword($data,strval($data->getMatricule()));
                $data->setPassword($hash);
            }else{
                $hash=$this->_encoder->hashPassword($data,$data->getPassword());
                $data->setPassword($hash);
            }
        }
        $pseudo=strtolower(substr($data->getPrenom(),0,1).".".$data->getNom());
        $data->setUsername($pseudo);
        $data->setMail($pseudo."@daher.com");

        $this->_entityManager->persist($data);
        $this->_entityManager->flush();
    }

    public function remove($data, array $context = [])
    {
        $this->_entityManager->remove($data);
        $this->_entityManager->flush();
    }
}