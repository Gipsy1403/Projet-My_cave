<?php

namespace App\Controller;

use App\Repository\BottleRepository;
use App\Repository\CellarRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class MesCavesController extends AbstractController{


#[Route('/mes/caves/{cellarId?}', name: 'mescaves_show')]
public function show( Request $request, CellarRepository $cellarRepository): Response 
{
    // Récupère l'utilisateur connecté
    $user = $this->getUser();
    	// vérifie que l'utilisateur soit bien connecté
    if (!$user) {
        throw $this->createAccessDeniedException('Veuillez vous authentifier en vous connectant.');
    }

    // recherche une cave de l'utilisateur dans la BdD
    $cellars = $cellarRepository->findBy(['user' => $user]);

    // Vérifie si l'identifiant de la cave est fourni
    $cellarId = $request->query->get('cellarId');
    $selectedCellar = $cellarRepository->findOneBy(['id' => $cellarId, 'user' => $user]);

    // Si aucune cave n'est trouvée, prendre la première par défaut
    if (!$selectedCellar && count($cellars) > 0) {
        $selectedCellar = $cellars[0];
    }

    // récupère les bouteilles associées à la cave de l'utilisateur sinon créé un tableau vide
    $bottles = $selectedCellar ? $selectedCellar->getBottles() : [];

    return $this->render('mes_caves/mescaves.html.twig', [
	// liste les bouteilles et les caves de l'utilisateur
        'bottles' => $bottles,
        'cellars' => $cellars,
        'selectedCellar' => $selectedCellar,
    ]);
}



    }
