<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UsersType;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Request,Response};
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

class UsersController extends AbstractController
{
    private $UsersRepository;
    private $entityManager;

    public function __construct(UsersRepository $UsersRepository,EntityManagerInterface $entityManager){
        $this->UsersRepository = $UsersRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/list-user", name="list-user")
     */
    public function listUser()
    {
        $userList = $this->UsersRepository->findAll();
        return $this->render('users/usersList.html.twig', [
        'users' => $userList,
        ]);
    }

    /**
     * @Route("/new", name="users_new", methods={"GET","POST"})
     */
    /*
    public function new(Request $request): Response
    {
        $user = new Users();
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$entityManager = $this->getDoctrine()->getManager();
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return $this->redirectToRoute('users_index');
        }

        return $this->render('users/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
     */
    
    /**
     * @Route("show-user/{id}", name="show-user", methods={"GET"})
     */
    public function show(Users $user): Response
    {
        $MyDeckList = $user->getListDecks();

        return $this->render('users/show.html.twig', [
            'deckList' => $MyDeckList,
            'user' => $user,
        ]);
    }

    /**
     * @Route("edit-user/{id}", name="edit-user", methods={"GET","POST"})
     */
    public function edit(Request $request, Users $user): Response
    {
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        $name = $user->getFirstName()." ".$user->getLastName();

        $id_current_user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            dd($form);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('users_index');
        }

        return $this->render('users/edit.html.twig', [
            'title' => "Modification de l'utilisateur $name",
            'current_user'=>$id_current_user,
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="users_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Users $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('users_index');
    }
}
