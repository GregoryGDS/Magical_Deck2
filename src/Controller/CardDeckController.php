<?php

namespace App\Controller;

use App\Entity\CardDeck;
use App\Repository\CardDeckRepository;
use App\Entity\Cards;
use App\Entity\Decks;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

class CardDeckController extends AbstractController
{
    private $CardDeckRepository;
    private $entityManager;

    public function __construct(CardDeckRepository $CardDeckRepository,EntityManagerInterface $entityManager){
        $this->CardDeckRepository = $CardDeckRepository;
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/card/deck", name="card_deck")
     */
    public function index()
    {
        return $this->render('card_deck/index.html.twig', [
            'controller_name' => 'CardDeckController',
        ]);
    }

    /**
     * @Route("/addCardDeck/{idCard}/{idDeck}", name="card_deck")
     */
    public function addCardInDeck(Cards $idCard, Decks $idDeck)
    {
        $cardDeck = new CardDeck();

        $cardDeck->setIdCard($idCard);
        $cardDeck->setIdDeck($idDeck);

        $this->entityManager->persist($cardDeck);
        $this->entityManager->flush();

        return $this->render('card_deck/index.html.twig', [
            'controller_name' => 'CardDeckController',
        ]);
    }

    /**
     * @Route("/deleteCardDeck/{idCardDeck}", name="cardDeck_delete")
     */
    public function deleteCardInDeck( int $idCardDeck)
    {
        $cardDeck = $this->CardDeckRepository->findOneBy(['id'=>$idCardDeck]);

        if ($cardDeck) {
            $this->entityManager->remove($cardDeck);
            $this->entityManager->flush();
        }
        return $this->redirectToRoute('list-deck');
    }


}
