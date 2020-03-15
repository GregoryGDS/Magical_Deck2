<?php

namespace App\Controller;

use App\Entity\Factions;
use App\Repository\FactionsRepository;
use App\Form\FactionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class FactionController extends AbstractController
{

    private $FactionsRepository;
    private $entityManager;

    public function __construct(FactionsRepository $FactionsRepository,EntityManagerInterface $entityManager){
        $this->FactionsRepository = $FactionsRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/list-faction", name="list-faction")
     */
    public function listFaction()
    {
        $factionList = $this->FactionsRepository->findAll();
        return $this->render('faction/factionList.html.twig', [
        'entities' => $factionList,
        ]);
    }

    /**
     * @Route("/create-faction", name="create-faction")
     */
    public function createFaction(
        Request $request
        )
    {
        $faction = new Factions();

        $form = $this->createForm(FactionType::class, $faction);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->entityManager->persist($faction);
            $this->entityManager->flush();

            return $this->redirectToRoute('list-faction');

        }
        return $this->render('form/Form.html.twig', [
            'title' => 'Création - faction',
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("edit-faction/{id}", name="edit-faction", methods={"GET","POST"})
     */
    public function edit(Request $request, Factions $faction)
    {
        $form = $this->createForm(FactionType::class, $faction);
        $form->handleRequest($request);

        $name = $faction->getName();

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('list-faction');
        }

        return $this->render('faction/edit.html.twig', [
            'title' => "Modification de la faction : $name",
            'faction' => $faction,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("faction_delete/{id}", name="faction_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Factions $faction): Response
    {
        if ($this->isCsrfTokenValid('delete'.$faction->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($faction);
            $entityManager->flush();
        }

        return $this->redirectToRoute('list-faction');
    }
}
