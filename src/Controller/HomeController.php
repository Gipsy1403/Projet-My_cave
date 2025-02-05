<?php

namespace App\Controller;

use App\Repository\BottleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController{
    #[Route('/', name: 'home')]
    public function index(BottleRepository $repository): Response
    {
		$bottle=$repository->findBy([],["id"=>"DESC"],4);
		
        return $this->render('home/index.html.twig', [
            'bottles' => $bottle,
        ]);
    }
}
