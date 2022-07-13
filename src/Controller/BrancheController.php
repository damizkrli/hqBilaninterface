<?php

namespace App\Controller;

use App\Entity\Branche;
use App\Repository\BrancheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BrancheController extends AbstractController
{
    private BrancheRepository $brancheRepository;

    public function __construct(BrancheRepository $brancheRepository)
    {
        $this->brancheRepository = $brancheRepository;
    }

    #[Route('/', name: 'app_branche')]
    public function index(): Response
    {
        $branches = $this->brancheRepository->findAll();

        return $this->render('branche/index.html.twig', [
            'branches' => $branches,
        ]);
    }


}
