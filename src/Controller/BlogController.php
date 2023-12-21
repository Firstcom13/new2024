<?php

namespace App\Controller;

use App\Repository\ArticlesBlogRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class BlogController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/blog', name: 'app_blog')]
    public function index(ArticlesBlogRepository $articlesBlogRepository, PaginatorInterface $paginator): Response
    {
        return $this->indexPaginated(1, $articlesBlogRepository, $paginator);
    }

    #[Route('/blog/{page<\d+>}', name: 'app_blog_paginated')]
    public function indexPaginated(int $page, ArticlesBlogRepository $articlesBlogRepository, PaginatorInterface $paginator): Response
    {
        $dernierArticle = $articlesBlogRepository->findLastArticle();
        $queryAutresArticles = $articlesBlogRepository->findAllExceptLastQuery();
        $categories = $articlesBlogRepository->findAllCategories();

        $pagination = $paginator->paginate(
            $queryAutresArticles,
            $page,
            2 // Vous pouvez ajuster le nombre d'articles par page si nécessaire
        );

        return $this->render('blog/index.html.twig', [
            'dernierArticle' => $dernierArticle,
            'pagination' => $pagination,
            'categories' => $categories,
        ]);
    }

    #[Route('/blog/categorie/{categoryName}/{page<\d+>?1}', name: 'blog_filter_by_category')]
    public function filterByCategory(string $categoryName, int $page = 1, ArticlesBlogRepository $articlesBlogRepository, PaginatorInterface $paginator): Response
    {
        // Récupération des articles de la catégorie spécifiée.
        $queryArticlesByCategory = $articlesBlogRepository->getArticlesByCategoryQuery($categoryName);

        // Paginer les résultats de la requête
        $pagination = $paginator->paginate(
            $queryArticlesByCategory, // la requête des articles par catégorie
            $page,
            2 // Nombre d'articles par page
        );

        // Récupération des catégories pour les afficher dans le filtre.
        $categories = $articlesBlogRepository->findAllCategories();

        // Récupération du dernier article pour l'affichage.
        $dernierArticle = $articlesBlogRepository->findLastArticle();

        return $this->render('blog/index.html.twig', [
            'pagination' => $pagination,
            'currentCategory' => $categoryName,
            'dernierArticle' => $dernierArticle,
            'categories' => $categories,
        ]);
    }
}
