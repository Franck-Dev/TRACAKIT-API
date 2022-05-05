<?php

// src/DataPersister

namespace App\DataPersister;

use App\Entity\DatasKits;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

class KitDataPersister implements ContextAwareDataPersisterInterface
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
        return $data instanceof DatasKits;
    }

    public function persist($data, array $context = [])
    {
        dd($data);
        // Si création on renvoie la date de création, sinon la date d emodification
        if (!$data->getCreatedAt()) {
            $data->setUpdateAt(new \DateTimeImmutable());
        } else {
            $data->setCreatedAt(new \DateTimeImmutable());
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