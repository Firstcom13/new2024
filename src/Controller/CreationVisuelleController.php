<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreationVisuelleController extends AbstractController
{
    #[Route('/creation-visuelle', name: 'app_creation_visuelle', options: ['sitemap' => ['section' => 'creation-de-contenus']])]
    public function index(): Response
    {
        return $this->render('creation-visuelle/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
