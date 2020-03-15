<?php

namespace App\Controller;

use App\Entity\Cards;
use App\Form\CardsType;
use App\Repository\CardsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\File\File;
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

            $id_user = $this->getUser();
            $card->setIdCreator($id_user);

            $image = $form->get('image')->getData();
            $date_format =  date('Y-m-d-H-i-s');
            $date = new DateTime($date_format);
            //si carte vide 
            if (!empty($image) || $image != null ) {
                $image_name = 'card-'.uniqid().'-'.$date->format.'.'.$image->guessExtension();
                $image->move(
                    $this->getParameter('cards_folder'),
                    $image_name
                );
            }else {
                $image_name = 'card-anonym.png';
            }
            
            $card->setImage($image_name);

            $this->entityManager->persist($card);
            $this->entityManager->flush();

            return $this->redirectToRoute('list-card');
        }

        return $this->render('form/Form.html.twig', [
            'title' => 'Création - carte',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/show-card/{id}", name="show-card", methods={"GET"})
     */
    public function show(Cards $card): Response
    {
        return $this->render('cards/show.html.twig', [
            'card' => $card,
        ]);
    }

    /**
     * @Route("/edit-card/{id}", name="edit-card", methods={"GET","POST"})
     */
    public function edit(Request $request, Cards $card): Response
    {
/*
        $image = $card->getImage();

        if (!empty($image)){

            $image = new File($this->getParameter('cards_folder')."/".$card->getImage());
        }
        else{

            $image = new File($this->getParameter('cards_folder')."/card-anonym.png");
        }

        $image = $card->getImage();
        $card->setImage($image);
*/

        $form = $this->createForm(CardsType::class, $card);
        $form->handleRequest($request);
        $name = $card->getName();
        $imageBDD = $card->getImage();

        if ($form->isSubmitted() && $form->isValid()) {
            

            if ($form->get("image")->getData() !== null){

                $image = $form->get('image')->getData();
                $date_format =  date('Y-m-d-H-i-s');
                $date = new DateTime($date_format);
                
                $image_name = 'card-'.uniqid().'-'.$date->format.'.'.$image->guessExtension();
                $image->move(
                    $this->getParameter('cards_folder'),
                    $image_name
                );
                $card->setImage($image_name);
            }else{
                //conserve ancienne image
                $card->setImage($imageBDD);

            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('list-card');
        }

        return $this->render('cards/edit.html.twig', [
            'title' => "Modification de la carte : $name",
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

        return $this->redirectToRoute('list-card');
    }
}
