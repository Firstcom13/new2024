<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComcriseController extends AbstractController
{
    #[Route('/communication-de-crise', name: 'app_crise')]
    public function index(): Response
    {
        return $this->render('comcrise/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
