<?php

namespace App\Controller;

use App\Entity\Page;
use App\Entity\BlocsPage;
use App\Entity\ModelesPage;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ArticlesBlogRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ArticlesBlogRepository $articlesBlogRepository): Response
    {

        $articles = $articlesBlogRepository->findAllArticles();
        // dd($articles);

        return $this->render('home/index.html.twig', [
            'articles' => $articles
        ]);
    }
    // gestion des pages dynamiques sauf /admin, /login /logout /contact
    // voir si possible faire autrement pour les exeptions /admin...
    // seo$ privisoire car est la même page que referencement-naturel-seo$ mais ne peut pas être supprimée via le BO pour l'instant
    #[Route("/{chemin}", name: "dynamic_page", requirements: ["chemin" => "^(?!admin$|login$|logout$|contact$|croissance$|conseil-et-strategie$|referencement-naturel-seo$|seo$|marketing-de-loffre$|communication-de-crise$|consulting-et-developpement$|campagnes-digitales$|mentions-legales$|gestion-des-cookies$|data-analyse$|community-management-et-rp$|creation-editoriale-et-storytelling$|agence$|declaration-environnementale$|tech-et-digital$).+"], methods: ["GET"])]

    public function loadPage(Request $request, EntityManagerInterface $entityManager, string $chemin)
    {
        $chemin =  $request->getRequestUri();

        $pageRepository = $entityManager->getRepository(Page::class);              

        $mapage = $pageRepository->findOneBy(['url' => $chemin]);

        if (!$mapage) {
            throw $this->createNotFoundException('Aucune page trouvée pour cette URL');
        }

        $modelepageRepository = $entityManager->getRepository(ModelesPage::class);
        $monmodele = $modelepageRepository->findOneBy(['id' => $mapage->getModele()]);

        $blocspageRepository = $entityManager->getRepository(BlocsPage::class);
        $mesblocs = $blocspageRepository->findBy(['page' => $mapage->getId()], ['datecreation' => 'ASC'] );

        $urlmodele = 'modeles_page/'.$monmodele->getUrl();
        // dd($mesblocs);
        return $this->render($urlmodele, [
                    'mapage' => $mapage,
                    'mesblocs' => $mesblocs,
        ]);       
    }
}
