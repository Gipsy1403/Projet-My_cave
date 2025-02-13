<?php

namespace App\Controller;

use App\Entity\Bottle;
use App\Entity\Cellar;
use App\Form\CellarType;
use App\Repository\BottleRepository;
use App\Repository\CellarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ViewCellarController extends AbstractController{
    #[Route('/view/cellar', name: 'viewcellar')]
    public function index(CellarRepository $cellarRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        return $this->render('view_cellar/viewcellar.html.twig', [
           'controller_name' => 'ViewCellarController',
        ]);
    }


//     public function index(CellarRepository $cellarRepository, BottleRepository $Repository,Request $request, EntityManagerInterface $entityManager): Response
//     {
// 	$user = $this->getUser();
// 	$cellars = $cellarRepository->findByUserCellars($user);
// 	$bottle = $Repository->findAll();

// 	if (!$cellars) {
// 		$this->addFlash('error', 'Vous devez d\'abord créer une cave avant d\'ajouter une bouteille.');
// 		return $this->redirectToRoute('explorer');
// 	 }
// 	$form = $this->createForm(CellarType::class,$cellars,[
// 		"user_cellars"=>$cellars,
// 	]);
// 	$form->handleRequest($request);
// 	if($form->isSubmitted() && $form->isValid()){
// 		$cellars->setUser($user);
// 		$cellars->addBottle($bottle);
// 		$entityManager->persist($cellars);
// 		$entityManager->flush();
// 		return $this->redirectToRoute('mescaves');
// 	}
// 	return $this->render('bottle/addupdate.html.twig', [
// 		'bottleform' => $form->createView(), 
// 	]);
// }
}
