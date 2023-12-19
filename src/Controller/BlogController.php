<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ArticlesBlogRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;

class BlogController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // Cette route répondra à une URL comme "/blog/2". Le "{page}" dans l'URL est une partie variable qui sera capturée et passée à la méthode "index" du contrôleur comme paramètre "$page".
    // "requirements" assure que seul un nombre peut être placé dans cette partie de l'URL, empêchant des valeurs non numériques d'être acceptées.
    #[Route('/blog/{page}', name: 'app_blog_paginated', requirements: ['page' => '\d+'], defaults: ['page' => 1])]


    // Cette route répondra à l'URL "/blog" sans aucune partie variable pour la pagination. Elle sera utilisée lorsque la pagination n'est pas nécessaire, comme pour la première page de la liste des articles du blog.
    // Ayant le même nom de contrôleur "index", cette route permet d'accéder à la première page de la liste des articles sans spécifier un numéro de page.
    #[Route('/blog', name: 'app_blog')]


    // La méthode "index" est conçue pour être flexible et fonctionner avec ou sans un numéro de page fourni dans l'URL.
    // Le paramètre "$page" a une valeur par défaut de "1", ce qui signifie que lorsque la route "app_blog" est utilisée sans spécifier de numéro de page,
    // la méthode agira comme si elle était appelée avec le numéro de page "1", affichant ainsi la première page des articles.
    public function index(int $page = 1, ArticlesBlogRepository $articlesBlogRepository, PaginatorInterface $paginator): Response
    {

        $dernierArticle = $articlesBlogRepository->findLastArticle();
        // dd($dernierArticle);

        // Obtenez la Query des articles (à l'exception du dernier)
        $queryAutresArticles = $articlesBlogRepository->findAllExceptLastQuery(); // Assurez-vous que cette méthode retourne une Query

        // Paginer les résultats de la Query
        $pagination = $paginator->paginate(
            $queryAutresArticles, // la Query et non le résultat
            $page, // Numéro de la page actuelle, 1 si aucune n'est définie
            4 // Nombre d'articles par page
        );

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'HomeController',
            'dernierArticle' => $dernierArticle,
            'pagination' => $pagination, // Passer l'objet de pagination au template
        ]);
    }
}
