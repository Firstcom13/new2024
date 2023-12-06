<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConsultingDeveloppementController extends AbstractController
{
    #[Route('/consulting-et-developpement', name: 'app_consulting_et_developpement')]
    public function index(): Response
    {
        return $this->render('consulting-et-developpement/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
