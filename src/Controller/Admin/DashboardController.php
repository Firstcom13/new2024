<?php

namespace App\Controller\Admin;

use App\Entity\ArticlesBlog;
use App\Entity\Reference;
use App\Entity\Categorie;
use App\Entity\User;
use App\Entity\Contact;
use App\Entity\Page;
use App\Entity\BlocsPage;
use App\Entity\ModelesPage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

//#[IsGranted('ROLE_ADMIN')]
class DashboardController extends AbstractDashboardController
{
    private $adminUrlGenerator;
    
    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        //$adminUrlGenerator = new AdminUrlGenerator();
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
            ->setController(ReferenceCrudController::class)
            ->generateUrl();

        return $this->redirect($url);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Firstcom')
            ->setTranslationDomain('app_home');
    }

    public function configureMenuItems(): iterable
    {
        //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);

        if ($this->isGranted('ROLE_ADMIN')) {
            yield MenuItem::section('Utilisateurs');
            yield MenuItem::subMenu('Actions', 'fas fa-bar')->setSubItems([
                MenuItem::linkToCrud('Créer', 'fas fa-plus-circle', User::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Liste des utilisateurs', 'fas fa-eye', User::class),
            ]);

            yield MenuItem::section('Articles blog');

            yield MenuItem::subMenu('Actions', 'fas fa-bar')->setSubItems([
                MenuItem::linkToCrud('Créer', 'fas fa-plus-circle', ArticlesBlog::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Liste des articles', 'fas fa-eye', ArticlesBlog::class),
            ]);

            yield MenuItem::section('Catégories');

            yield MenuItem::subMenu('Actions', 'fas fa-bar')->setSubItems([
                MenuItem::linkToCrud('Créer', 'fas fa-plus-circle', Categorie::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Liste des catégories', 'fas fa-eye', Categorie::class),
            ]);

            yield MenuItem::section('Modèles Pages');

            yield MenuItem::subMenu('Actions', 'fas fa-bar')->setSubItems([
                MenuItem::linkToCrud('Création', 'fas fa-plus-circle', ModelesPage::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('List', 'fas fa-eye', ModelesPage::class),
            ]);
        }
            yield MenuItem::section('Pages');

            yield MenuItem::subMenu('Actions', 'fas fa-bar')->setSubItems([
                MenuItem::linkToCrud('Création', 'fas fa-plus-circle', Page::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('List', 'fas fa-eye', Page::class),
            ]);

            yield MenuItem::section('Blocs Pages');

            yield MenuItem::subMenu('Actions', 'fas fa-bar')->setSubItems([
                MenuItem::linkToCrud('Création', 'fas fa-plus-circle', BlocsPage::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('List', 'fas fa-eye', BlocsPage::class),
            ]);
        
            yield MenuItem::section('Références');

            yield MenuItem::subMenu('Actions', 'fas fa-bar')->setSubItems([
                MenuItem::linkToCrud('Création', 'fas fa-plus-circle', Reference::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('List', 'fas fa-eye', Reference::class),
            ]);

            yield MenuItem::section('Demandes de Contact');

            yield MenuItem::subMenu('Actions', 'fas fa-bar')->setSubItems([
                MenuItem::linkToCrud('Création', 'fas fa-plus-circle', Contact::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('List', 'fas fa-eye', Contact::class),
            ]);
       // }
    }
}
