<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CroissanceController extends AbstractController
{
    #[Route('/croissance-et-performance', name: 'app_croissance')]
    public function index(): Response
    {
        return $this->render('croissance/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
