<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MentionsLegalesController extends AbstractController
{
    #[Route('/mentions-legales', name: 'app_mentions_legales' , options: ['sitemap' => ['section' => 'mention-legales']])]
    public function index(): Response
    {
        return $this->render('mentions-legales/index.html.twig', [
            'controller_name' => 'Mentions légales',
        ]);
    }
}
