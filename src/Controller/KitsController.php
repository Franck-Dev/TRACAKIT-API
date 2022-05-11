<?php
// api/src/Controller/KitsController.php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\DatasKits;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class KitsController extends AbstractController
{


    public function __invoke(DatasKits $data): DatasKits
    {
        //$this->userPublishingHandler->handle($data);
        $data->setStatus(false);
        return $data;
    }
}
