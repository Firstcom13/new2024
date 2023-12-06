<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarketingOffreController extends AbstractController
{
    #[Route('/marketing-de-loffre', name: 'app_marketing_de_loffre')]
    public function index(): Response
    {
        return $this->render('marketing-de-loffre/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
