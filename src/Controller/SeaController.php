<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeaController extends AbstractController
{
    #[Route('/campagnes-digitales', name: 'app_campagnes_digitales', options: ['sitemap' => ['section' => 'croissance-et-performance']])]
    public function index(): Response
    {
        return $this->render('sea/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
