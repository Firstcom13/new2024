<?php

namespace App\Controller;

use App\Repository\ArticlesBlogRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    #[Route('/article/{id}/{slug}', name: 'app_article_show')]
    public function show(int $id, ArticlesBlogRepository $articlesBlogRepository): Response
    {
        $article = $articlesBlogRepository->find($id);

        if (!$article) {
            throw $this->createNotFoundException('L\'article demandé n\'existe pas.');
        }

        // Récupération des derniers articles sauf l'article en cours de consultation
        $limit = 2; // Nombre d'articles à récupérer
        $derniersArticles = $articlesBlogRepository->findLatestArticlesExceptCurrent($id, $limit);
        // dd($derniersArticles);

        // Récupération de toutes les catégories
        $categories = $articlesBlogRepository->findAllCategories();

        // Supposons que $article->getTitre() renvoie le titre avec des balises <div>
        $title = strip_tags($article->getTitre(), '<allowed><tags>');
        $metaDescription = strip_tags($article->getMetaDescription(), '<allowed><tags>');

        // dd($metaDescription);

        return $this->render('article/index.html.twig', [
            'article' => $article,
            'title' => $title,
            'metaDescription' => $metaDescription,
            'derniersArticles' => $derniersArticles,
            'categories' => $categories,
        ]);
    }
}
