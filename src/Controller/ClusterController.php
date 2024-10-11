<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClusterController extends AbstractController
{
    #[Route('/agence-data-marketing-et-web-analyse-marseille', name: 'app_agence_data_marketing')]
    public function index(): Response
    {
        return $this->render('cluster/agence-data-marketing.html.twig', [
            'controller_name' => 'HomeController',
            
        ]);
    }

    #[Route('/agence-referencement-naturel-et-contenu-marseille', name: 'app_agence_referencement_naturel')]
    public function ref(): Response
    {
        return $this->render('cluster/agence-referencement-naturel.html.twig', [
            'controller_name' => 'HomeController',
            
        ]);
    }

    #[Route('/agence-social-media-marseille', name: 'app_agence_social_media')]
    public function social(): Response
    {
        return $this->render('cluster/agence-social-media.html.twig', [
            'controller_name' => 'HomeController',
            
        ]);
    }

    #[Route('/agence-webmarketing-marseille', name: 'app_agence_webmarketing')]
    public function webmarketing(): Response
    {
        return $this->render('cluster/agence-webmarketing.html.twig', [
            'controller_name' => 'HomeController',
            
        ]);
    }

    #[Route('/agence-campagnes-publicitaires-et-marketing-marseille', name: 'app_agence_campagnes_publicitaires_et_marketing')]
    public function campagnes_publicitaires(): Response
    {
        return $this->render('cluster/agence-campagnes-publicitaires-et-marketing.html.twig', [
            'controller_name' => 'HomeController',
            
        ]);
    }

    #[Route('/agence-creation-et-gestion-de-contenu-marseille', name: 'app_agence_creation_et_gestion_de_contenu')]
    public function creation_contenu(): Response
    {
        return $this->render('cluster/agence-creation-et-gestion-de-contenu.html.twig', [
            'controller_name' => 'HomeController',
            
        ]);
    }

    #[Route('/agence-strategie-de-communication-digitale-marseille', name: 'app_agence_strategie_de_communication_digitale')]
    public function strategie_digitale(): Response
    {
        return $this->render('cluster/agence-strategie-de-communication-digitale.html.twig', [
            'controller_name' => 'HomeController',
            
        ]);
    }
}
