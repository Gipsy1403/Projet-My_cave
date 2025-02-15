<?php

namespace App\Controller;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;
use App\Form\ResetPasswordFormType;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ResetPasswordRequestFormType;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

final class ResetPasswordController extends AbstractController{
	#[Route('/reset/password', name: 'app_forgot_password')]
	public function request(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
{	
	// création du formulaire pour réinitialiser le mot de passe
	$form=$this->createForm(ResetPasswordRequestFormType::class);
	$form->handleRequest($request);

	if($form->isSubmitted() && $form->isValid()){
		// récupère le mail du formulaire
		$email = $form->get("email")->getData();
		$user = $userRepository->findOneBy(["email"=>$email]);
		// vérifie si l'utilisateur avec cet email existe
		if ($user) {
			// token généré pour 1h
			$token = Uuid::v4()->toRfc4122();
			$user->setResetToken($token);
			$user->setResetTokenExpiresAt((new \DateTime())->modify("+1 hour"));
			$entityManager->flush();
			// lien de réinitialisation généré avec le token
			$resetLink = $this->generateUrl("app_reset_password", ['token'=>$token], UrlGeneratorInterface:: ABSOLUTE_URL);
			// prépare et envoi l'email
			$email=(new Email())
			->from("noreply@yourdomain.com")
			->to($user->getEmail())
			->subject ("Réinitialisation de votre mot de passe")
			->text("Voici votre lien de réinitialisation : $resetLink");
			$mailer->send($email);

			$this->addFlash("success", "un email de réinitialisation a été envoyé");
			// redirige l'utilisateur vers la page Se connecter
			return $this->redirectToRoute("app_login");
		}
		$this->addFlash("error", "Aucun utilisateur trouvé pour cet email.");
	}
	return $this->render('reset_password/request.html.twig', [
		"requestForm"=>$form->createView(),
	]);
}
		

    #[Route('/reset/password/{token}', name: 'app_reset_password')]
	public function reset(string $token, Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
{		
		// l'utilisateur est recherché par le token de réinitialisation et vérifie s'il est valide ou non
		$user=$userRepository->findOneBy(["resetToken"=>$token]);
		if(!$user || !$user->isResetTokenValid()){
			$this->addFlash("danger", "Ce lien de réinitialisation est invalide ou expiré.");
			return $this->redirectToRoute("app_forgot_password");
		}
	// le formulaire pour créer le nouveau mot de passe est créé
	$form=$this->createForm(ResetPasswordFormType::class);
	$form->handleRequest($request);

	if($form->isSubmitted() && $form->isValid()){
		// récupére et hache le mot de passe nouvellement créé
		$password=$form->get("plainPassword")->getData();
		$hashedPassword =password_hash($password, PASSWORD_BCRYPT);
		$user->setPassword($hashedPassword);
		// destruction du token utilisé
		$user->setResetToken(null);
		$user->setResetTokenExpiresAt(null);
		// sauvegarde dans la BdD
		$entityManager->flush();

		
		$this->addFlash("success", "Votre mot de passe a été mis à jour avec succès.");
		
		return $this->redirectToRoute("app_login");
	}
	return $this->render('reset_password/reset_password.html.twig', [
		"resetForm"=>$form->createView(),
	]);
}
}