<?php

namespace App\Controller;
use App\Entity\Cards;
use App\Entity\Users;
use App\Repository\CardsRepository;
use App\Repository\UsersRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ExportCSVController extends AbstractController
{
    /**
     * @Route("/export_csv/{name}", name="export_csv")
     */
    public function index($name,CardsRepository $CardsRepository, UsersRepository $UsersRepository)
    {
        //gestion csv
        if($name == 'cards') {
            $donnees = $CardsRepository->findAll();
            $name = 'all_cards';
        }
        if($name == 'users') {
            $donnees = $UsersRepository->findAll();
            $name = 'all_users';
        }
        

        //gestion csv
        $export = fopen('php://output','r+');
        foreach ($donnees as $donnee ) {
            fputcsv($export, $donnee->arrayExport());
        }
        fclose($export);
        //envoie de la réponse
        $response = new Response();
        $response->headers->set('Content-type','text/csv');
        $response->headers->set('Content-Disposition','attachement; filename="export_$name.csv"');
        return $response;
    }
}
