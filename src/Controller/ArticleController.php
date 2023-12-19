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

        // // Créer une instance de AsciiSlugger
        // $slugger = new AsciiSlugger();
        // // Génération du slug attendu à partir du titre de l'article
        // $expectedSlug = $slugger->slug($article->getTitre())->lower();

        // Comparaison du slug attendu avec celui passé dans l'URL
        // if ($slug !== $expectedSlug) {
        //     // Si le slug ne correspond pas, redirigez vers l'URL correcte
        //     return $this->redirectToRoute('app_article_show', [
        //         'id' => $id,
        //         'slug' => $expectedSlug,
        //     ]);
        // }

        return $this->render('article/index.html.twig', [
            'article' => $article,
        ]);
    }
}
