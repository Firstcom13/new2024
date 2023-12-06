<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TechDigitalController extends AbstractController
{
    #[Route('/tech-et-digital', name: 'app_tech_digital')]
    public function index(): Response
    {
        return $this->render('tech-et-digital/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
