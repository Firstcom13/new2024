<?php

namespace App\Controller;

use App\Repository\ArticlesBlogRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    #[Route('/article/{id}/{slug}', name: 'app_article_show')]
    public function show(int $id, string $slug, ArticlesBlogRepository $repository): Response
    {
        $article = $repository->find($id);
        // dd($article);

        if (!$article) {
            throw $this->createNotFoundException('L\'article demandé n\'existe pas.');
        }

        // Supposons que $article->getTitre() renvoie le titre avec des balises <div>
        $title = strip_tags($article->getTitre(), '<allowed><tags>');
        $metaDescription = strip_tags($article->getMetaDescription(), '<allowed><tags>');

        // dd($metaDescription);

        return $this->render('article/index.html.twig', [
            'article' => $article,
            'title' => $title,
            'metaDescription' => $metaDescription,
        ]);
    }
}
