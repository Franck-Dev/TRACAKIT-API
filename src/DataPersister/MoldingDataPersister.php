<?php

// src/DataPersister

namespace App\DataPersister;

use App\Entity\Molding;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

class MoldingDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $_entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        $this->_entityManager = $entityManager;
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
        // Si création on renvoie la date de création, sinon la date d emodification
        if (!$data->getcreatedAt()) {
            $data->setcreatedAt(new \DateTimeImmutable());
        } else {
            $data->setupdatedAt(new \DateTimeImmutable());
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