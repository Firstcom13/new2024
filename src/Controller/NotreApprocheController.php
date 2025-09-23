<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NotreApprocheController extends AbstractController
{
    #[Route('/notre-approche', name: 'app_notre_approche', options: ['sitemap' => ['section' => 'agence']], priority: 2)]
    public function index(): Response
    {
        return $this->render('notre-approche/index.html.twig', [
            'controller_name' => 'NotreApprocheController',
        ]);
    }
}
