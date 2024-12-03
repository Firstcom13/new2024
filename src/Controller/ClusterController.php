<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClusterController extends AbstractController
{
    #[Route('/agence-data-marketing-et-web-analyse-marseille', name: 'app_agence_data_marketing', options: ['sitemap' => ['section' => 'agence-data-marketing-et-web-analyse-marseille']])]
    public function index(): Response
    {
        return $this->render('cluster/agence-data-marketing.html.twig', [
            'controller_name' => 'HomeController',
            
        ]);
    }

    #[Route('/agence-referencement-naturel-et-contenu-marseille', name: 'app_agence_referencement_naturel', options: ['sitemap' => ['section' => 'agence-referencement-naturel-et-contenu-marseille']])]
    public function ref(): Response
    {
        return $this->render('cluster/agence-referencement-naturel.html.twig', [
            'controller_name' => 'HomeController',
            
        ]);
    }

    #[Route('/agence-social-media-marseille', name: 'app_agence_social_media', options: ['sitemap' => ['section' => 'agence-social-media-marseille']])]
    public function social(): Response
    {
        return $this->render('cluster/agence-social-media.html.twig', [
            'controller_name' => 'HomeController',
            
        ]);
    }

    #[Route('/agence-webmarketing-marseille', name: 'app_agence_webmarketing', options: ['sitemap' => ['section' => 'agence-webmarketing-marseille']])]
    public function webmarketing(): Response
    {
        return $this->render('cluster/agence-webmarketing.html.twig', [
            'controller_name' => 'HomeController',
            
        ]);
    }

    #[Route('/agence-campagnes-publicitaires-et-marketing-marseille', name: 'app_agence_campagnes_publicitaires_et_marketing', options: ['sitemap' => ['section' => 'agence-campagnes-publicitaires-et-marketing-marseille']])]
    public function campagnes_publicitaires(): Response
    {
        return $this->render('cluster/agence-campagnes-publicitaires-et-marketing.html.twig', [
            'controller_name' => 'HomeController',
            
        ]);
    }

    #[Route('/agence-creation-et-gestion-de-contenu-marseille', name: 'app_agence_creation_et_gestion_de_contenu', options: ['sitemap' => ['section' => 'agence-creation-et-gestion-de-contenu-marseille']])]
    public function creation_contenu(): Response
    {
        return $this->render('cluster/agence-creation-et-gestion-de-contenu.html.twig', [
            'controller_name' => 'HomeController',
            
        ]);
    }

    #[Route('/agence-strategie-de-communication-digitale-marseille', name: 'app_agence_strategie_de_communication_digitale', options: ['sitemap' => ['section' => 'agence-strategie-de-communication-digitale-marseille']])]
    public function strategie_digitale(): Response
    {
        return $this->render('cluster/agence-strategie-de-communication-digitale.html.twig', [
            'controller_name' => 'HomeController',
            
        ]);
    }
}
