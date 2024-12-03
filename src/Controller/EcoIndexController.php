<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EcoIndexController extends AbstractController
{
    #[Route('/ecoindex', name: 'app_ecoindex', options: ['sitemap' => ['section' => 'ecoindex']])]
    public function index(): Response
    {
        return $this->render('ecoindex/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
