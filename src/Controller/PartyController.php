<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PartyController extends Controller
{
    /**
     * @Route("/party", name="party")
     */
    public function index()
    {
        return $this->render('party/index.html.twig', [
            'controller_name' => 'PartyController',
        ]);
    }
}
