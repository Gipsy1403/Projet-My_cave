<?php

namespace App\Controller;

use App\Repository\BottleRepository;
use App\Repository\CellarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

// #[IsGranted('ROLE_USER')]
final class MesCavesController extends AbstractController{
    #[Route('/mes/caves', name: 'mescaves')]
    public function index(BottleRepository $repository,CellarRepository $cellarRepository): Response
    {
		$user=$this->getUser();
		// $bottle=$repository->findby(["user"=>$user]);
		// $cellar=$cellarRepository->findby(["user"=>$user]);
		
		$bottle=$repository->findAll();
		$cellar=$cellarRepository->findAll();
		

        return $this->render('mes_caves/mescaves.html.twig', [
            'bottles' => $bottle,
            'cellars' => $cellar,
		  
        ]);
    }
}
