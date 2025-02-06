<?php

namespace App\Controller;

use App\Entity\Bottle;
use App\Form\BottleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_USER')]
final class BottleController extends AbstractController{
    #[Route('/bottle/{id}', name: 'modify_bottle')]
    #[Route('/bottle', name: 'add_bottle')]
    public function index(Bottle $bottle = null,Request $request, EntityManagerInterface $entityManager): Response
    {
		if(!$bottle){
			$bottle=new Bottle;
		}
	$form = $this->createForm(BottleType::class,$bottle);
	$form->handleRequest($request);
	if($form->isSubmitted() && $form->isValid()){
			// dd($bottle);
		$bottle->setUser($this->getUser("id"));
		$entityManager->persist($bottle);

		$entityManager->flush();
		return $this->redirectToRoute('explorer');
	}
	return $this->render('bottle/addupdate.html.twig', [
		'bottleform' => $form->createView(), 
		'isModification' => $bottle->getId() !== null 
	]);
}

    #[Route('/bottle/delete/{id}', name: 'delete_bottle')]
    public function remove(Bottle $bottle, Request $request, EntityManagerInterface $entityManager): Response
    {
      
        if($this->isCsrfTokenValid('SUP'.$bottle->getId(),$request->get('_token'))){
            $entityManager->remove($bottle);
            $entityManager->flush();
            $this->addFlash('success','La suppression à été effectuée');
            return $this->redirectToRoute('home');
        }
    }
}
