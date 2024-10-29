<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DataController extends AbstractController
{
    #[Route('/data-analyse', name: 'app_data_analyse', options: ['sitemap' => ['section' => 'croissance-et-performance']])]
    public function index(): Response
    {
        return $this->render('data-analyse/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
