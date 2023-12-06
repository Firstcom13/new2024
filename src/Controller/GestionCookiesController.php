<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionCookiesController extends AbstractController
{
    #[Route('/gestion-des-cookies', name: 'app_gestion_cookies')]
    public function index(): Response
    {
        return $this->render('gestion-cookies/index.html.twig', [
            'controller_name' => 'Politique de confidentialité',
        ]);
    }
}
