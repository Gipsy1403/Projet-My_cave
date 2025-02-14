<?php

namespace App\Controller;

use App\Entity\Cellar;
use App\Form\CellarType;
use App\Repository\BottleRepository;
use App\Repository\CellarRepository;
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

	//    Permettre à l'utilisateur d'ajouter une bouteille dans une de ses caves dont il doit choisir
	#[Route('/mescaves/bottles_add/{ids}/{id}', name: 'bottles_add')]
	public function BottlesAdd(Cellar $cellar, EntityManagerInterface $manager, BottleRepository $repo,$ids): Response
	{
	    $thisTable  = $cellar->getId();    
	    $bottle  = $repo->find($ids);
	    
	    $cellar->addBottle($bottle);
	  
	    $manager->persist($cellar);
	    $manager->flush();
	    $this->addFlash("success","Votre vin a été ajouté dans votre cave");
 
 
	    return $this->redirectToRoute('mes_caves' , [
		   'id' => $thisTable
	    ]);
	}
    }

    
