<?php

// src/DataPersister

namespace App\DataPersister;

use App\Entity\Molding;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

class MoldingDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $_entityManager;

    /**
     *
     * @var Security
     */
    private $_security;

    public function __construct(
        EntityManagerInterface $entityManager, Security $security
    )
    {
        $this->_entityManager = $entityManager;
        $this->_security = $security;
    }

    /**
     * {@inheritdoc}
     */
    
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Molding;
    }

    public function persist($data, array $context = [])
    {
        dd($this->_security->getUser());
        // Si création on renvoie les données de création, sinon celles de modification
        if (!$data->getcreatedAt()) {
            $data->setcreatedAt(new \DateTimeImmutable());
            $data->setcreatedBy($this->_security->getUser());
        } else {
            $data->setupdatedAt(new \DateTimeImmutable());
            $data->setmodifiedBy($this->_security->getUser());
        }
        $this->_entityManager->persist($data);
        $this->_entityManager->flush();
    }

    public function remove($data, array $context = [])
    {
        $this->_entityManager->remove($data);
        $this->_entityManager->flush();
    }
}