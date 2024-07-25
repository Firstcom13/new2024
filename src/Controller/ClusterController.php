<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClusterController extends AbstractController
{
    #[Route('/agence-data-marketing', name: 'app_agence_data_marketing')]
    public function index(): Response
    {
        return $this->render('cluster/agence-data-marketing.html.twig', [
            'controller_name' => 'HomeController',
            
        ]);
    }

    #[Route('/agence-referencement-naturel', name: 'app_agence_referencement_naturel')]
    public function ref(): Response
    {
        return $this->render('cluster/agence-referencement-naturel.html.twig', [
            'controller_name' => 'HomeController',
            
        ]);
    }

    #[Route('/agence-social-media', name: 'app_agence_social_media')]
    public function social(): Response
    {
        return $this->render('cluster/agence-social-media.html.twig', [
            'controller_name' => 'HomeController',
            
        ]);
    }

    #[Route('/agence-webmarketing', name: 'app_agence_webmarketing')]
    public function webmarketing(): Response
    {
        return $this->render('cluster/agence-webmarketing.html.twig', [
            'controller_name' => 'HomeController',
            
        ]);
    }
}
