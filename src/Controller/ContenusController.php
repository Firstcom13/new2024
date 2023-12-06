<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContenusController extends AbstractController
{
    #[Route('/creation-de-contenus', name: 'app_contenus')]
    public function index(): Response
    {
        return $this->render('contenus/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
