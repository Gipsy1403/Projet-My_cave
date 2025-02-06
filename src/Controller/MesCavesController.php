<?php

namespace App\Controller;

use App\Repository\BottleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MesCavesController extends AbstractController{
    #[Route('/mes/caves', name: 'mescaves')]
    public function index(BottleRepository $repository): Response
    {
		$bottle=$repository->findAll();

        return $this->render('mes_caves/mescaves.html.twig', [
            'bottles' => $bottle,
        ]);
    }
}
