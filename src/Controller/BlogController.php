<?php

namespace App\Controller;

// Importation des classes nécessaires
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ArticlesBlogRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// Définition de la classe BlogController qui étend AbstractController
class BlogController extends AbstractController
{
    // Propriété pour stocker l'instance de EntityManagerInterface
    private EntityManagerInterface $entityManager;

    // Constructeur pour initialiser le BlogController avec EntityManagerInterface
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // Route pour la page principale du blog
    #[Route('/blog', name: 'app_blog')]
    public function index(ArticlesBlogRepository $articlesBlogRepository, PaginatorInterface $paginator): Response
    {
        // Renvoie vers la fonction indexPaginated pour gérer la pagination à partir de la première page
        return $this->indexPaginated(1, $articlesBlogRepository, $paginator);
    }

    // Route pour les pages paginées du blog
    #[Route('/blog/{page<\d+>}', name: 'app_blog_paginated')]
    public function indexPaginated(int $page, ArticlesBlogRepository $articlesBlogRepository, PaginatorInterface $paginator): Response
    {
        // Récupération du dernier article publié
        $dernierArticle = $articlesBlogRepository->findLastArticle();

        // Récupération d'une requête pour tous les articles sauf le dernier
        $queryAutresArticles = $articlesBlogRepository->findAllExceptLastQuery();

        // Récupération de toutes les catégories
        $categories = $articlesBlogRepository->findAllCategories();

        // Configuration de la pagination pour les articles
        $pagination = $paginator->paginate(
            $queryAutresArticles, // Requête pour les autres articles
            $page, // Numéro de la page actuelle
            4 // Nombre d'articles par page (ajustable)
        );

        // Rendu du template Twig avec les données nécessaires
        return $this->render('blog/index.html.twig', [
            'dernierArticle' => $dernierArticle,
            'pagination' => $pagination,
            'categories' => $categories,
        ]);
    }


    // Route pour filtrer les articles par catégorie
    #[Route('/blog/categorie/{categoryName}/{page<\d+>?1}', name: 'blog_filter_by_category')]
    public function filterByCategory(string $categoryName, int $page = 1, ArticlesBlogRepository $articlesBlogRepository, PaginatorInterface $paginator): Response
    {
        // Récupération du dernier article publié dans la catégorie spécifique
        $dernierArticle = $articlesBlogRepository->findLastArticleFromCategory($categoryName);
        // dd($dernierArticle);

        // Récupération d'une requête pour les articles d'une catégorie spécifique
        $queryArticlesByCategory = $articlesBlogRepository->getArticlesByCategoryQuery($categoryName);

        // Configuration de la pagination pour les articles filtrés par catégorie
        $pagination = $paginator->paginate(
            $queryArticlesByCategory,
            $page,
            4 // Nombre d'articles par page (ajustable)
        );

        // Récupération des catégories pour affichage dans le filtre
        $categories = $articlesBlogRepository->findAllCategories();

        // Rendu du template Twig avec les données filtrées
        return $this->render('blog/category.html.twig', [
            'pagination' => $pagination,
            'currentCategory' => $categoryName,
            'categories' => $categories,
            'dernierArticle' => $dernierArticle,
        ]);
    }
}
