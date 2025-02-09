<?php

namespace App\Controller;

use App\Entity\Cellar;
use App\Form\CellarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_USER')]
final class AddCellarController extends AbstractController{
    	#[Route('/add/cellar', name: 'add_cellar')]
	#[Route('/cellar/{id}', name: 'modify_cellar')]
	
	public function index(Cellar $cellar = null,Request $request, EntityManagerInterface $entityManager): Response
	   {
		    if(!$cellar){
			    $cellar=new Cellar;
		    }
	    $form = $this->createForm(CellarType::class,$cellar);
	    $form->handleRequest($request);
	    if($form->isSubmitted() && $form->isValid()){
			    // dd($cellar);
		    $cellar->setUser($this->getUser("id"));
		    $entityManager->persist($cellar);
    
		    $entityManager->flush();
		    return $this->redirectToRoute('mescaves');
	    }
	    return $this->render('mes_caves/addcellar.html.twig', [
		    'cellarForm' => $form->createView(), 
		    'isModification' => $cellar->getId() !== null 
	    ]);
    }
    
	   #[Route('/cellar/delete/{id}', name: 'delete_cellar')]
	   public function remove(Cellar $cellar, Request $request, EntityManagerInterface $entityManager): Response
	   {
		
		  if($this->isCsrfTokenValid('SUP'.$cellar->getId(),$request->get('_token'))){
			 $entityManager->remove($cellar);
			 $entityManager->flush();
			 $this->addFlash('success','La suppression à été effectuée');
			 return $this->redirectToRoute('mescaves');
		  }
	   }
    }
