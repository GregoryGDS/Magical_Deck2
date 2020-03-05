<?php

namespace App\Controller;

use App\Entity\Cards;
use App\Form\CardsType;
use App\Repository\CardsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

class CardsController extends AbstractController
{

    private $CardsRepository;
    private $entityManager;

    public function __construct(CardsRepository $CardsRepository,EntityManagerInterface $entityManager){
        $this->CardsRepository = $CardsRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/list-card", name="list-card")
     */
    public function listCard()
    {
        $cardList = $this->CardsRepository->findAll();
        return $this->render('cards/cardsList.html.twig', [
        'cards' => $cardList,
        ]);
    }

    /**
     * @Route("/create-card", name="create-card", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $card = new Cards();
        $form = $this->createForm(CardsType::class, $card);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$cards=$this->entityManager->getRepository(Cards::class)->findAll();

            $id_user = $this->getUser();
            $card->setIdCreator($id_user);

            $this->entityManager->persist($card);
            $this->entityManager->flush();

            return $this->redirectToRoute('list-card');
        }

        return $this->render('form/Form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/card/{id}", name="cards_show", methods={"GET"})
     */
    public function show(Cards $card): Response
    {
        return $this->render('cards/show.html.twig', [
            'card' => $card,
        ]);
    }

    /**
     * @Route("/card/{id}/edit", name="cards_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cards $card): Response
    {
        $form = $this->createForm(CardsType::class, $card);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cards_index');
        }

        return $this->render('cards/edit.html.twig', [
            'card' => $card,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/card/{id}", name="cards_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cards $card): Response
    {
        if ($this->isCsrfTokenValid('delete'.$card->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($card);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cards_index');
    }
}
