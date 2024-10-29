<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreationEditorialeController extends AbstractController
{
    #[Route('/creation-editoriale-et-storytelling', name: 'app_creation_editoriale', options: ['sitemap' => ['section' => 'creation-de-contenus']])]
    public function index(): Response
    {
        return $this->render('creation-editoriale-et-storytelling/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
