<?php

namespace App\Controller;
use App\Entity\Cards;
use App\Entity\Users;
use App\Repository\CardsRepository;
use App\Repository\UsersRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;

class ExportCSVController extends AbstractController
{
    /**
     * @Route("/export_csv/{name}", name="export_csv")
     */
    public function index($name,CardsRepository $CardsRepository, UsersRepository $UsersRepository)
    {
        //config
        if($name == 'cards') {
            $donnees = $CardsRepository->findAll();
        }
        if($name == 'users') {
            $donnees = $UsersRepository->findAll();
        }
        
        // $date =  date('Y-m-d-H-i-s');
        // $date = new DateTime($date);
        
        // $name_export = 'export-'.$date->format.'-'.$name;

        //gestion csv
        $export = fopen('php://output','r+');
        foreach ($donnees as $donnee ) {
            //dd($donnee->arrayExport());
            fputcsv($export, $donnee->arrayExport());
        }
        fclose($export);
        //dd($export);
        
        //envoie de la réponse
        $response = new Response();
        $response->headers->set("Content-Type", "text/csv");
        $response->headers->set("Content-Disposition", "attachment; filename='export.csv'");

        return $response;
    }
}