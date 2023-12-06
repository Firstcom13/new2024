<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeclarationController extends AbstractController
{
    #[Route('/declaration-environnementale', name: 'app_declaration_environnementale')]
    public function index(): Response
    {
        return $this->render('declaration/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
