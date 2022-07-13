<?php

namespace App\Controller;

use App\Dto\Branche\AddBranche;
use App\Dto\Branche\EditBranche;
use App\Dto\Email\AddEmail;
use App\Entity\Branche;
use App\Form\Branche\CreateBrancheType;
use App\Form\Branche\CreateEmailType;
use App\Form\Branche\DeleteEmailType;
use App\Form\Branche\EditBrancheType;
use App\Repository\BrancheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
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

    #[Route('/', name: 'branche')]
    public function index(): Response
    {
        $branches = $this->brancheRepository->findAll();

        return $this->render('branche/index_branche.html.twig', [
            'branches' => $branches,
        ]);
    }

    /**
     * Ajout d'une branche.
     *
     * @Route("/add/branche", name="add_branche", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $addBranche = new AddBranche();
        $form = $this->createForm(CreateBrancheType::class, $addBranche);

        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            $branche = new Branche(' ', ' ');
            $branche->addBranche($addBranche->nom, $addBranche->mail);
            $entityManager->persist($branche);
            $entityManager->flush();

            return $this->redirectToRoute('branche', ['id', $branche->getIdBranche()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('branche/add_branche.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * Met a jour une branche.
     *
     * @Route("/edit/branche/{id}", name="edit_branche", methods={"GET","POST"})
     */
    public function edit(Request $request, Branche $branche, EntityManagerInterface $entityManager): Response
    {
        $brancheName = $branche->getNom();

        $editBranche = new EditBranche();
        $editBranche->nom = $branche->getNom();

        $form = $this->createForm(EditBrancheType::class, $editBranche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $branche->update($editBranche->nom);
            $entityManager->persist($branche);
            $entityManager->flush();

            return $this->redirectToRoute('branche', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('branche/edit_branche.html.twig', ['branche' => $branche,
                                                                'form'    => $form->createView(),]);
    }

    /**
     * Efface une branche.
     *
     * @Route("/delete/{id}", name="delete_branche", methods={"POST"})
     */
    public function delete(Request $request, Branche $branche, EntityManagerInterface $entityManager): RedirectResponse
    {
        $deleteBranche = $branche->getNom();

        if ($this->isCsrfTokenValid('delete' . $branche->getIdBranche(), $request->request->get('_token'))) {
            $entityManager->remove($branche);
            $entityManager->flush();
        }

        return $this->redirectToRoute('branche', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * Index des adresses emails sur la branche en cours.
     *
     * @Route("/email/{id}", name="index_email")
     */
    public function indexEmail(
        Branche $branche
    ): Response
    {
        $mailByCurrentBranche = $branche->getMails();

        return $this->render('branche/index_email.html.twig', [
            'mailByCurrentBranche' => $mailByCurrentBranche,
            'branche'              => $branche,
        ]);
    }

    /**
     * Ajoute une adresse email.
     *
     * @Route("/email/new/{id}", name="add_email", methods={"GET", "POST"})
     */
    public function addEmail(
        Request                $request,
        EntityManagerInterface $entityManager,
        Branche                $branche
    )
    {
        $addEmail = new AddEmail($branche);
        $form = $this->createForm(CreateEmailType::class, $addEmail);

        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            $branche->addEmail($addEmail->mail);
            $entityManager->persist($branche);
            $entityManager->flush();

            return $this->redirectToRoute('index_email', ['id' => $branche->getIdBranche()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('branche/add_email.html.twig', [
            'branche' => $branche,
            'form'    => $form,
        ]);
    }

    /**
     * Supprime une adresse email.
     *
     * @Route("/email/delete/{id}", name="delete_email", methods={"GET", "POST"})
     */
    public function deleteEmail(
        Request                $request,
        Branche                $branche,
        EntityManagerInterface $entityManager
    ): Response
    {
        $form = $this->createForm(DeleteEmailType::class);

        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            $branche->deleteEmail($form->get('mail')->getData());
            $entityManager->persist($branche);
            $entityManager->flush();
        }

        return $this->redirectToRoute('index_email', ['id' => $branche->getIdBranche()], Response::HTTP_SEE_OTHER);
    }
}
