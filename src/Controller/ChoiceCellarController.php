<?php

namespace App\Controller;

use App\Repository\CellarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ChoiceCellarController extends AbstractController{
    #[Route('/choice/cellar/{id}', name: 'choicecellar')]
    public function index(int $id,CellarRepository $repository): Response
    {
	$cellar=$repository->find($id);
	if (!$cellar){
		throw $this->createNotFoundException(("Cave non trouvée."));
	}
	$bottle=$cellar->getBottles();

     return $this->render('choice_cellar/choicecellar.html.twig', [
		'cellar'=>$cellar,
		'bottles'=>$bottle,


//         return $this->render('choice_cellar/choicecellar.html.twig', [
//             'controller_name' => 'ChoiceCellarController',
        ]);
//     }


}
}
