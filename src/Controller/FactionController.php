<?php

namespace App\Controller;
use App\Entity\Factions;
use App\Repository\FactionsRepository;
use App\Form\FactionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\ORM\EntityManagerInterface;

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
            'form' => $form->createView(),
        ]);
    }


}
