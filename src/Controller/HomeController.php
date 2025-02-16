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


// Voir plus... affiche la carte au complet si la description n'est pas affichée dans sa globalité
    #[Route('view/bottles/{id}', name: 'viewbottle')]
    public function viewBottle(int $id, BottleRepository $repository): Response
    {
		// Récupère la bouteille par son identifiant
	    $bottle = $repository->findOneBy(["id"=>$id]); 
// dump($bottle);
// die();
        return $this->render('home/viewbottle.html.twig', [
            'bottles' => $bottle,
        ]);
    }
}
