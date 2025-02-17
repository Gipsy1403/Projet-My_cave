<?php

namespace App\Controller;

use App\Entity\Bottle;
use App\Entity\User;
use App\Form\AddBottleCellarType;
use App\Form\BottleType;
use App\Repository\BottleRepository;
use App\Repository\CellarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

// #[IsGranted('ROLE_USER')]
// final class AddBottleCellarController extends AbstractController
// {
//     #[Route('/add/bottle/cellar/{ids}', name: 'addbottlecellar')]
//     public function index(Bottle $bottle, CellarRepository $cellarRepository, EntityManagerInterface $entityManager, BottleRepository $repo, Request $request, $ids): Response
//     {
//         $user = $this->getUser();
//         if (!$user) {
//             throw $this->createAccessDeniedException("Veuillez vous connecter pour ajouter un vin à votre cave.");
//         }
// dd($user);
//         // Récupère la bouteille à partir de l'ID fourni
//         $bottle = $repo->find($ids);
//         if (!$bottle) {
//             throw $this->createNotFoundException("La bouteille n'a pas été trouvée.");
//         }
//         // Récupère toutes les caves de l'utilisateur
//         $cellars = $cellarRepository->findBy(["user" => $user]);
	   
//         if (!$cellars) {
// 		   throw $this->createAccessDeniedException("Vous devez avoir au moins une cave pour ajouter des vins.");
// 		}
		
// 		// Si le formulaire est soumis
// 		if ($request->isMethod('POST')) {
// 			$cellarId = $request->request->get('cellar');  // Récupère l'ID de la cave choisie par l'utilisateur
// 			$cellar = $cellarRepository->find($cellarId);
			
// 			if ($cellar) {
// 				// Ajoute la bouteille à la cave sélectionnée
// 				if (!$cellar->getBottles()->contains($bottle)) {
// 					$cellar->addBottle($bottle);
// 					$entityManager->persist($cellar);
// 					$entityManager->flush();
// 					$this->addFlash('success', 'Le vin a été ajouté à votre cave.');
// 				}
// 			}
// 			// dd($user,$bottle,$cellars);

//             return $this->redirectToRoute('mescaves_show');
//         }

//         // Afficher le formulaire de sélection de cave
//         return $this->render('explorer/explorer.html.twig', [
//             'bottle' => $bottle,
//             'cellars' => $cellars, // Assurez-vous que la variable cellars est bien passée ici
//         ]);
//     }
// }


#[IsGranted('ROLE_USER')]
final class AddBottleCellarController extends AbstractController{
	// code modifié
	//     #[Route('/add/bottle/cellar/{ids}/{id}', name: 'addbottlecellar')]
	// fin du code modifié
	
	#[Route('/add/bottle/cellar/{id}', name: 'addbottlecellar')]
    public function index(Bottle $bottle,BottleRepository $repo, CellarRepository $cellarRepository,Request $request, $id, EntityManagerInterface $entityManager): Response
    {

	    $user=$this->getUser();
	    if (!$user) {
		    throw $this->createAccessDeniedException("Veuillez vous connecter pour ajouter un vin à votre cave.");
		}
		$bottle= $repo->find($id);
		
		$cellaruser=$cellarRepository->findBy(["user"=>$user]);
		
		if (!$cellaruser) {
			throw $this->createAccessDeniedException("Veuillez choisir votre cave.");
		}
		$form = $this->createForm(AddBottleCellarType::class,$cellaruser);
		$form->handleRequest($request);
		// dd($cellaruser);
		if ($form->isSubmitted() && $form->isValid()) {
			// Récupérer la cave sélectionnée
			$cellar = $form->get('cellar')->getData();
			// foreach($cellars as $cellar){
				if (!$cellar->getBottles()->contains($bottle)) {
					$cellar->addBottle($bottle);
					
					// dd($cellaruser);
		$entityManager->persist($cellar);
		$entityManager->flush();

		$this->addFlash('success', 'La bouteille de vin a été ajoutée à votre cave.');
	 }
	// }
		return $this->redirectToRoute('mescaves_show');
	}

        return $this->render('mes_caves/addbottlecellar.html.twig', [
            'bottles' => $bottle,
		//   'cellaruser' => $cellaruser,
		  "form"=>$form->createView(),
        ]);
    }
}