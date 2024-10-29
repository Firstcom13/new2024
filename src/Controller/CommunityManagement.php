<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommunityManagement extends AbstractController
{
    #[Route('/community-management-et-rp', name: 'app_community_management', options: ['sitemap' => ['section' => 'croissance-et-performance']])]
    public function index(): Response
    {
        return $this->render('community-management-et-rp/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
