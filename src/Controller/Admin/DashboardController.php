<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Bottle;
use App\Entity\Cellar;
use App\Entity\Grapes;
use App\Entity\Region;
use App\Entity\Country;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Http\Attribute\IsGranted;
// use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

// #[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
	#[IsGranted('ROLE_ADMIN')]
	#[Route('/admin', name: 'admin')]
    public function index(): Response
    {
	return $this->render('admin/index.html.twig');
     //    return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // 1.1) If you have enabled the "pretty URLs" feature:
        // return $this->redirectToRoute('admin_user_index');
        //
        // 1.2) Same example but using the "ugly URLs" that were used in previous EasyAdmin versions:
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirectToRoute('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Mycave');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de Bord', 'fa fa-home');
        yield MenuItem::linkToCrud('Vins', 'fas fa-list', Bottle::class);
	   yield MenuItem::linkToCrud('Régions', 'fas fa-list', Region::class);
	   yield MenuItem::linkToCrud('Pays', 'fas fa-list', Country::class);
	   yield MenuItem::linkToCrud('Cépages', 'fas fa-list', Grapes::class);
	   yield MenuItem::linkToCrud('Les utilisateurs', 'fas fa-list', User::class);
	   yield MenuItem::linkToCrud('Les caves', 'fas fa-list', Cellar::class);
	   

    }
}
