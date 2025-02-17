<?php

namespace App\Controller;

use App\Entity\Bottle;
use App\Repository\BottleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ViewController extends AbstractController{
    #[Route('/viewbottle/{id}', name: 'viewbottle')]
    public function index($id,BottleRepository $repo): Response
    { 
	$bottle=$repo-> find($id);
        return $this->render('home/viewbottle.html.twig', [
          //   'controller_name' => 'ViewController',
		  "bottles"=> $bottle,
        ]);
    }
}
