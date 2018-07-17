<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PartyController extends Controller
{
    /**
     * Cette méthode affiche la page "Partie"
     * @Route("/party", name="party")
     */
    public function index()
    {

        Calcul.generateCalcul();
        return $this->render('party/index.html.twig', [
            'controller_name' => 'PartyController',
        ]);
    }
}
