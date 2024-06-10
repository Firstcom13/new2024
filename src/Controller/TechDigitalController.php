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
            'controller_name' => 'TechDigitalController',
        ]);
    }

    #[Route('/tech-et-digital/sites-web', name: 'app_tech_digital_sites_web')]
    public function sites_web(): Response
    {
        return $this->render('tech-et-digital/sites-web.html.twig', [
            'controller_name' => 'TechDigitalController',
        ]);
    }

    #[Route('/tech-et-digital/digitalisation', name: 'app_tech_digital_digitalisation')]
    public function digitalisation(): Response
    {
        return $this->render('tech-et-digital/digitalisation.html.twig', [
            'controller_name' => 'TechDigitalController',
        ]);
    }
}