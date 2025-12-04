<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ComingSoonController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('coming_soon.html.twig');
    }
}
