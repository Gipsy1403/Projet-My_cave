<?php

namespace App\Controller;

use App\Entity\Bottle;
use App\Entity\User;
use App\Repository\BottleRepository;
use App\Repository\CellarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

#[IsGranted('ROLE_USER')]
final class AddBottleCellarController extends AbstractController{
    #[Route('/add/bottle/cellar/{id}', name: 'addbottlecellar')]
    public function index(Bottle $bottle,CellarRepository $cellarRepository, EntityManagerInterface $entityManager): Response
    {
	$user=$this->getUser();
	if (!$user) {
		throw $this->createAccessDeniedException("Veuiller vous connecter pour ajouter un vin à votre cave.");
	}
	$cellar=$cellarRepository->findOneBy(["user"=>$user]);
	if (!$cellar) {
		throw $this->createAccessDeniedException("Veuiller choisir votre cave.");
	
	}
	if (!$cellar->getBottles()->contains($bottle)) {
		$cellar->addBottle($bottle);
		$entityManager->persist($cellar);
		$entityManager->flush();

		$this->addFlash('success', 'Le vin a ajouté à votre cave.');
	 }
		return $this->redirectToRoute('mescaves');

     //    return $this->render('explorer/explorer.html.twig', [
     //        'bottles' => $bottle,
	// 	  'cellars'=> $cellar,
     //    ]);
    }
}
