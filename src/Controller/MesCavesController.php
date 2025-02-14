<?php

namespace App\Controller;

use App\Repository\BottleRepository;
use App\Repository\CellarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

// #[IsGranted('ROLE_USER')]
final class MesCavesController extends AbstractController{
    #[Route('/mes/caves', name: 'mescaves')]
    public function index(BottleRepository $repository,CellarRepository $cellarRepository, Request $request): Response
    {
		
	$filter=$request->get("filter","all");
	if($filter == 'all'){
		$bottle = $repository->findAll();
	}elseif($filter =="ASC"){
		$bottle = $repository->findByOrderAsc();
	}elseif($filter =="DESC"){
		$bottle = $repository->findByOrderDesc();
	}


	
		$cellar=$cellarRepository->findAll();
		

        return $this->render('mes_caves/mescaves.html.twig', [
            'bottles' => $bottle,
            'cellars' => $cellar,
		  
        ]);
    }
    

}
