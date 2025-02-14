<?php

namespace App\Controller;

use App\Form\FiltreType;
use App\Repository\BottleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class FiltresController extends AbstractController{
    #[Route('/filtres', name: 'filtres')]
    public function index(BottleRepository $repository, Request $request): Response
    {
	$filter=$request->get("filter","all");
		if($filter == 'all'){
			$bottle = $repository->findAll();
		}elseif($filter =="ASC"){
			$bottle = $repository->findByOrderAsc();
		}elseif($filter =="DESC"){
			$bottle = $repository->findByOrderDesc();
		}
		$form = $this->createForm(FiltreType::class);
		$form->handleRequest($request);
		if($form->isSubmitted()&&$form->isValid()){
			$data=$form->getData();
			dd($data);
		}
        return $this->render('filtres/filtres.html.twig', [
		'bottles' => $bottle,
		"filtreform"=>$form->createView(),
          
        ]);
    }
}
