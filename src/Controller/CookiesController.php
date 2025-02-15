<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CookiesController extends AbstractController{
    #[Route('/cookies', name: 'cookies_policy')]
    public function cookies(): Response
    {
        return $this->render('cookies/policy.html.twig', [
            'controller_name' => 'CookiesController',
        ]);
    }

    public function index(Request $request): Response
	{
   		$cookieConsent = $request->cookies->get('cookie_consent');
    		if ($cookieConsent) {
			$this->addFlash("success", "Les cookies sont acceptés !");
		}else{
			$this->addFlash("alert", "Les cookies n'ont pas été acceptés !");
		}
    	return $this->render('home/index.html.twig');
	}
}
