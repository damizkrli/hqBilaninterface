<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Dto\RelSectionBranche\AddSecteur;
use App\Dto\RelSectionBranche\EditSecteur;
use App\Entity\RelSectionBranche;
use App\Form\SearchFormType;
use App\Form\Secteur\CreateSecteurType;
use App\Form\Secteur\EditSecteurType;
use App\Repository\BrancheRepository;
use App\Repository\RelSectionBrancheRepository;
use Doctrine\ORM\EntityManagerInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class SecteurController extends AbstractController
{
    /**
     * @var RelSectionBrancheRepository
     */
    private $relSectionBrancheRepository;
    /**
     * @var BrancheRepository
     */
    private $brancheRepository;
    /**
     * @var FlashyNotifier
     */
    private $notifier;

    public function __construct(
        RelSectionBrancheRepository $relSectionBrancheRepository,
        FlashyNotifier $notifier
    ) {
        $this->relSectionBrancheRepository = $relSectionBrancheRepository;
        $this->notifier = $notifier;
    }

    /**
     * @Route("/secteur", name="secteur")
     */
    public function index(RelSectionBrancheRepository $relSectionBrancheRepository, Request $request): Response
    {
        $data = new SearchData();
        $form = $this->createForm(SearchFormType::class, $data);
        $form->handleRequest($request);

        $sectors = $relSectionBrancheRepository->findBySearch($data);

        return $this->render('secteur/index_secteur.html.twig', [
            'sectors' => $sectors,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Ajout d'un secteur.
     *
     * @Route("/add/secteur", name="add_secteur", methods={"GET", "POST"})
     */
    public function addSecteur(Request $request, EntityManagerInterface $entityManager): Response
    {
        $addSecteur = new AddSecteur();
        $form = $this->createForm(CreateSecteurType::class, $addSecteur);

        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            $secteur = new RelSectionBranche(' ', ' ');
            $secteur->addSecteur($addSecteur->libelle, $addSecteur->horsect, $addSecteur->branche);
            $entityManager->persist($secteur);
            $entityManager->flush();
            $this->notifier->success('Le secteur à été ajouté avec succès');

            return $this->redirectToRoute('secteur', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('secteur/add_secteur.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * Met à jour un secteur.
     *
     * @Route("/edit/secteur/{idRelSecBra}", name="edit_secteur", methods={"GET", "POST"})
     */
    public function edit(
        Request $request,
        RelSectionBranche $relSectionBranche,
        EntityManagerInterface $entityManager
    ): Response {
        $secteurName = $relSectionBranche->getLibelle();

        $editSecteur = new EditSecteur();
        $editSecteur->libelle = $relSectionBranche->getLibelle();
        $editSecteur->horsect = $relSectionBranche->getHorsect();
        $editSecteur->branche = $relSectionBranche->getBranche();

        $form = $this->createForm(EditSecteurType::class, $editSecteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $relSectionBranche->update(
                $editSecteur->libelle,
                $editSecteur->horsect,
                $editSecteur->branche
            );
            $entityManager->persist($relSectionBranche);
            $entityManager->flush();
            $this->notifier->success($secteurName . ' a été modifié avec succès');

            return $this->redirectToRoute('secteur', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('secteur/edit_secteur.html.twig', [
            'secteur' => $relSectionBranche,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Supprime un secteur.
     *
     * @Route("/sector/delete/{idRelSecBra}", name="delete_secteur", methods={"GET", "POST"})
     */
    public function delete(
        Request $request,
        RelSectionBranche $relSectionBranche,
        EntityManagerInterface $entityManager
    ): Response {
        $secteurName = $relSectionBranche->getLibelle();

        if ($this->isCsrfTokenValid('delete' . $relSectionBranche->getIdRelSecBra(), $request->request->get('_token'))) {
            $entityManager->remove($relSectionBranche);
            $entityManager->flush();
            $this->notifier->success(
                'Le secteur "' . $secteurName . '" à bien été supprimé.'
            );
        }

        return $this->redirectToRoute('secteur', ['id' => $relSectionBranche->getIdRelSecBra()], Response::HTTP_SEE_OTHER);
    }
}
