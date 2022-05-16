<?php
// api/src/Controller/MoldingsController.php

namespace App\Controller;

use App\Entity\Molding;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/* @AsController()
*/
class MoldingsController extends AbstractController
{
    public function __invoke(Molding $data): Molding
    {
        //$this->userPublishingHandler->handle($data);
        $data->setIsActive(false);
        return $data;
    }
}
