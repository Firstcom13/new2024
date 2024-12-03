<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class   ConseilController extends AbstractController
{
    #[Route('/conseil-et-strategie', name: 'app_conseil', options: ['sitemap' => ['section' => 'conseil-et-strategie']])]
    public function index(): Response
    {
        return $this->render('conseil/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
