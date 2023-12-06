<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeoController extends AbstractController
{
    #[Route('/referencement-naturel-seo', name: 'app_referencement_naturel_seo')]
    public function index(): Response
    {
        return $this->render('seo/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
