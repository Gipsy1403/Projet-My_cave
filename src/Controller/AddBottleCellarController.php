<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AddBottleCellarController extends AbstractController{
    #[Route('/add/bottle/cellar', name: 'addbottlecellar')]
    public function index(): Response
    {
        return $this->render('add_bottle_cellar/addbottlecellar.html.twig', [
            'controller_name' => 'AddBottleCellarController',
        ]);
    }
}
