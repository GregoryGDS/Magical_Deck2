<?php

namespace App\Controller;

use App\Entity\Types;
use App\Form\TypeForm;
use App\Repository\TypesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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


}
