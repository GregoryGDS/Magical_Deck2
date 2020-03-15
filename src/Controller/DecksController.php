<?php

namespace App\Controller;

use App\Entity\Decks;
use App\Entity\Cards;
use App\Form\DecksType;
use App\Repository\DecksRepository;
use App\Repository\CardsRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;


class DecksController extends AbstractController
{

    private $DecksRepository;
    private $entityManager;

    public function __construct(DecksRepository $DecksRepository,EntityManagerInterface $entityManager){
        $this->DecksRepository = $DecksRepository;
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/list-deck", name="list-deck", methods={"GET"})
     */
    public function index(): Response
    {
        $id_user = $this->getUser();
        $deckList = $this->DecksRepository->findBy(array('idUser'=>$id_user));
        return $this->render('decks/decksList.html.twig', [
        'decks' => $deckList
        ]);
    }

    /**
     * @Route("/create-deck", name="create-deck", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $deck = new Decks();
        $form = $this->createForm(DecksType::class, $deck);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $id_user = $this->getUser();
            $deck->setIdUser($id_user);

            $this->entityManager->persist($deck);
            $this->entityManager->flush();

            return $this->redirectToRoute('list-deck');
        }

        return $this->render('form/Form.html.twig', [
            'title' => 'Création - deck',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("show-deck/{id}", name="show-deck", methods={"GET"})
     */
    public function show(Decks $deck): Response
    {
        $cardListDeck = $deck->getCardDecks();
        $owner = $deck->getIdUser();

        return $this->render('decks/show.html.twig', [
            'owner' => $owner,
            'cardListDeck' => $cardListDeck,
            'deck' => $deck
        ]);
    }

    /**
     * @Route("edit-deck/{id}", name="edit-deck", methods={"GET","POST"})
     */
    public function edit(Request $request, Decks $deck,CardsRepository $CardsRepository): Response
    {

        $form = $this->createForm(DecksType::class, $deck);
        $form->handleRequest($request);
        
        $deckName = $deck->getName();

        $cardsListStorage = $CardsRepository->findAll();
        $cardListDeck = $deck->getCardDecks();

        //màj du nom 
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('show-deck',['id'=>$deck->getId()]); 
        }

        return $this->render('decks/edit.html.twig', [
            'title' => "Edition du deck - $deckName",
            'cardListDeck' => $cardListDeck,
            'cardsListStorage' => $cardsListStorage,
            'deck' => $deck,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="deck_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Decks $deck): Response
    {
        if ($this->isCsrfTokenValid('delete'.$deck->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($deck);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('list-deck');
    }
}
