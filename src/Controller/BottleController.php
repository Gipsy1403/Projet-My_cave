<?php

namespace App\Controller;

use App\Entity\Bottle;
use App\Form\BottleType;
use App\Repository\CellarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_USER')]
final class BottleController extends AbstractController{
#[Route('/bottle', name: 'add_bottle')]
#[Route('/bottle/{id}', name: 'modify_bottle')]
public function index(Bottle $bottle = null, Request $request, EntityManagerInterface $entityManager, CellarRepository $cellarRepository): Response
{
    // Récupère l'utilisateur connecté
    $user = $this->getUser();

    // Si la bouteille n'existe pas encore, on la crée
    if (!$bottle) {
        $bottle = new Bottle();
    }

    // Création du formulaire
    $form = $this->createForm(BottleType::class, $bottle);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Récupère la cave sélectionnée par l'utilisateur (ex: depuis un champ dans le formulaire)
        $selectedCellarId = $request->request->get('selectedCellar');

        if ($selectedCellarId) {
            $cellar = $cellarRepository->find($selectedCellarId);
            if ($cellar) {
                $cellar->addBottle($bottle);
                $entityManager->persist($cellar); // Met à jour la cave
            }
        }

        $entityManager->persist($bottle);
        $entityManager->flush();

        return $this->redirectToRoute('mescaves_show');
    }

    // Récupère toutes les caves de l'utilisateur pour afficher la sélection
    $cellars = $cellarRepository->findBy(['user' => $user]);

    return $this->render('bottle/addupdate.html.twig', [
        'bottleform' => $form->createView(),
        'cellars' => $cellars, // Envoie les caves à la vue
        'isModification' => $bottle->getId() !== null
    ]);
}


#[Route('/bottle/delete/{id}', name: 'delete_bottle')]
public function remove(Bottle $bottle, Request $request, EntityManagerInterface $entityManager): Response
{
    if ($this->isCsrfTokenValid('SUP' . $bottle->getId(), $request->get('_token'))) {
        // Retirer la bouteille de toutes les caves où elle est présente
        foreach ($bottle->getCellar() as $cellar) {
            $cellar->removeBottle($bottle);  // Retire la bouteille de la cave
        }

        // Persister les modifications (supprime seulement la relation entre la bouteille et les caves)
        $entityManager->flush();

        // Afficher un message de confirmation
        $this->addFlash('success', 'La bouteille a été retirée de votre cave.');

        // Rediriger vers la page des caves
        return $this->redirectToRoute('mescaves_show');
    }

    // Si la CSRF est invalide ou quelque chose ne va pas
    $this->addFlash('error', 'Une erreur est survenue lors de la suppression de la bouteille.');
    return $this->redirectToRoute('mescaves_show');
}

    
}
