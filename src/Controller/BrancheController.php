<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BrancheController extends AbstractController
{
    #[Route('/branche', name: 'app_branche')]
    public function index(): Response
    {
        return $this->render('branche/index.html.twig', [
            'controller_name' => 'BrancheController',
        ]);
    }
}
