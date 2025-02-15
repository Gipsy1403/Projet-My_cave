<?php

namespace App\Controller;

use App\Repository\BottleRepository;
use App\Repository\CellarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MesCavesController extends AbstractController{
    #[Route('/mes/caves', name: 'mescaves')]
    public function index(BottleRepository $repository,CellarRepository $cellarRepository): Response
    {
	// récupère l'utilisateur connecté
	$user = $this->getUser();
	// vérifie que l'utilisateur soit bien connecté
	if (!$user) {
	    throw $this->createAccessDeniedException('Veuillez vous authentifier en vous connectant.');
	}
	// recherche une cave de l'utilisateur dans la BdD
	$cellar = $cellarRepository->findOneBy(['user' => $user]);
	// récupère les bouteilles associées à la cave de l'utilisateur sinon créé un tableau vide
	$bottles=$cellar?$cellar->getBottles():[];
		

        return $this->render('mes_caves/mescaves.html.twig', [
		// liste les bouteilles et les caves de l'utilisateur
            'bottles' => $bottles,
            'cellars' => $cellar,
		  
        ]);

	// $user = $this->getUser();

     //    if (!$user) {
     //        throw $this->createAccessDeniedException('Vous devez être connecté.');
     //    }

     //    // Récupère toutes les caves de l'utilisateur
     //    $cellars = $cellarRepository->findBy(['user' => $user]);

     //    // Récupère toutes les bouteilles disponibles
     //    $bottles = $repository->findAll();

     //    return $this->render('mes_caves/mescaves.html.twig', [
     //        'bottles' => $bottles,
     //        'cellars' => $cellars, // On envoie toutes les caves de l'utilisateur
     //    ]);
    }
    

}
