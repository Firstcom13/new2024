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
use Symfony\Component\HttpFoundation\JsonResponse;

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
    public function index(ArticlesBlogRepository $articlesBlogRepository): Response
    {

        $dernierArticle = $articlesBlogRepository->findLastArticle();
        $articles = $articlesBlogRepository->findArticlesFromIndex(0);
        $categories = $articlesBlogRepository->findAllCategories();
         return $this->render('blog/index.html.twig', [
            'dernierArticle' => $dernierArticle,
            'articles' => $articles,
            'categories' => $categories,
        ]);

    }

    #[Route('/blog/get-article-from-index-{index}', name: 'get-article')]
    public function getArticle(ArticlesBlogRepository $articlesBlogRepository, int $index): Response
    {
        $articles = $articlesBlogRepository->findArticlesFromIndex($index);

        if(!array_key_exists("message",$articles)){
            /* étant donné que $articles renvoie une liste d'objet PHP ArticleBlog, le mieux est 
            de convertir les différents objets en array avec paire clé-valeurs, afin de l'encoder en JSON
            et que Javascript l'interprète avec les valeurs dont on a besoin*/
            $articleArray = [];
            foreach ($articles as &$article){
                $categorie_array = [];
                foreach ($article->getCategorie() as &$categorie){
                    array_push($categorie_array, $categorie->getNom());
                }
                array_push($articleArray, [
                    'id' => $article->getId(),
                    'titre' => $article->getTitre(),
                    'description_courte' => $article->getDescriptionCourte(),
                    'categorie' => $categorie_array,
                    'date_creation' => $article->getDateCreation(),
                    'imgS' => $article->getImgS(),
                ]);
            };

            // Créer une réponse avec le type de contenu approprié
            return new Response(json_encode($articleArray), Response::HTTP_OK, ['Content-Type' => 'application/json']);
        }

        //Retourne ['message' => 'Il n\'y a plus d\'autres articles à générer.']
        return new Response(json_encode($articles), Response::HTTP_OK, ['Content-Type' => 'application/json']);

        
    }

    // Route pour les pages paginées du blog
    // #[Route('/blog/{page<\d+>}', name: 'app_blog_paginated')]
    // public function indexPaginated(int $page, ArticlesBlogRepository $articlesBlogRepository, PaginatorInterface $paginator): Response
    // {
    //     // Récupération du dernier article publié
    //     $dernierArticle = $articlesBlogRepository->findLastArticle();

    //     // Récupération d'une requête pour tous les articles sauf le dernier
    //     $queryAutresArticles = $articlesBlogRepository->findAllExceptLastQuery();

    //     // Récupération de toutes les catégories
    //     $categories = $articlesBlogRepository->findAllCategories();

    //     // Configuration de la pagination pour les articles
    //     $pagination = $paginator->paginate(
    //         $queryAutresArticles, // Requête pour les autres articles
    //         $page, // Numéro de la page actuelle
    //         4 // Nombre d'articles par page (ajustable)
    //     );

    //     // Rendu du template Twig avec les données nécessaires
    //     return $this->render('blog/index.html.twig', [
    //         'dernierArticle' => $dernierArticle,
    //         'pagination' => $pagination,
    //         'categories' => $categories,
    //     ]);
    // }


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
