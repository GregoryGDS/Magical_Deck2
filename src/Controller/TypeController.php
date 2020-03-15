<?php

namespace App\Controller;

use App\Entity\Types;
use App\Form\TypeForm;
use App\Repository\TypesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Doctrine\ORM\EntityManagerInterface;

class TypeController extends AbstractController
{

    private $TypesRepository;
    private $entityManager;

    public function __construct(TypesRepository $TypesRepository,EntityManagerInterface $entityManager){
        $this->TypesRepository = $TypesRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/list-type", name="list-type")
     */
    public function listType()
    {
        $typeList = $this->TypesRepository->findAll();
        return $this->render('type/typeList.html.twig', [
        'entities' => $typeList,
        ]);
    }

    /**
     * @Route("/create-type", name="create-type")
     */
    public function createType(
        Request $request
        )
    {
        $type = new Types();

        $form = $this->createForm(TypeForm::class, $type);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->entityManager->persist($type);
            $this->entityManager->flush();

            return $this->redirectToRoute('list-type');
        }
        return $this->render('form/Form.html.twig', [
            'title' => 'Création - type',
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("edit-type/{id}", name="edit-type", methods={"GET","POST"})
     */
    public function edit(Request $request, Types $type)
    {
        $form = $this->createForm(TypeForm::class, $type);
        $form->handleRequest($request);

        $name = $type->getName();

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('list-type');
        }

        return $this->render('type/edit.html.twig', [
            'title' => "Modification du type : $name",
            'type' => $type,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete_type/{id}", name="delete_type", methods={"DELETE"})
     */
    public function delete(Request $request, Types $type): Response
    {
        if ($this->isCsrfTokenValid('delete'.$type->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($type);
            $entityManager->flush();
        }

        return $this->redirectToRoute('list-type');
    }

}
