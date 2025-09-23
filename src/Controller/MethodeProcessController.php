<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MethodeProcessController extends AbstractController
{
    #[Route('/methode-et-process', name: 'app_methode_et_process', options: ['sitemap' => ['section' => 'agence']], priority: 2)]
    public function index(): Response
    {
        return $this->render('methode-et-process/index.html.twig', [
            'controller_name' => 'MethodeProcessController',
        ]);
    }
}
