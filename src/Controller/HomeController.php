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

    #[Route('view/bottles/{id}', name: 'explorer_bottle')]
    public function viewBottle(int $id, BottleRepository $repository): Response
    {
		// Récupère la bouteille par son identifiant
	    $bottle = $repository->findOneBy(["id"=>$id]); 
// dump($bottle);
// die();
        return $this->render('explorer/viewbottle.html.twig', [
            'bottles' => $bottle,
        ]);
    }
}
