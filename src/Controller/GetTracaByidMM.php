<?php
// api/src/Controller/CreateBookPublication.php

namespace App\Controller;

use App\Entity\DatasKits;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class GetTracaByidMM extends AbstractController
{
    private $bookPublishingHandler;

    /* public function __construct(BookPublishingHandler $bookPublishingHandler)
    {
        $this->bookPublishingHandler = $bookPublishingHandler;
    }

    public function __invoke(Book $data): Book
    {
        $this->bookPublishingHandler->handle($data);

        return $data;
    } */
}