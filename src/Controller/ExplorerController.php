<?php

namespace App\Controller;

use App\Form\FiltreType;
use App\Repository\BottleRepository;
use App\Repository\CellarRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ExplorerController extends AbstractController{
    #[Route('explorer/', name: 'explorer')]
    public function index(BottleRepository $repository): Response
    {
	$bottle = $repository->findAll();
		
        return $this->render('explorer/explorer.html.twig', [
		'bottles' => $bottle,
		

        ]);
    }
}
