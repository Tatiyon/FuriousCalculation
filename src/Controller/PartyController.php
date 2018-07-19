<?php

namespace App\Controller;

use App\Entity\Calcul;
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
        $entityManager = $this->getDoctrine()->getManager();

        $this->removeAllCalculs();

        $this->generateCalculs();

        $calculs = $this->getDoctrine()
            ->getRepository(Calcul::class)
            ->findAll();

        return $this->render('party/index.html.twig', [
            'calculs' => $calculs,
        ]);
    }

    private function removeAllCalculs(){
        $entityManager = $this->getDoctrine()->getManager();

        $calculs = $this->getDoctrine()
            ->getRepository(Calcul::class)
            ->findAll();


        foreach ($calculs as $calcul){
            $entityManager->remove($calcul);
        }

        $entityManager->flush();
    }

    private function generateCalculs(){
        $entityManager = $this->getDoctrine()->getManager();
        $correspondenceArray    = array ("I","II","III","IV","V","VI","VII","VIII","IX","X");
        $minNumberRandom        = 1;
        $maxNumberRandom        = 10;

        //Nombre de calculs générés
        $calculationAmount = 60;

        for ($i = 1; $i <= $calculationAmount; $i++) {
            $firstNumber    = rand ($minNumberRandom  , $maxNumberRandom );
            $secondNumber   = rand ($minNumberRandom  , $maxNumberRandom );

            $symbols = array(
                "+",
                "-",
                "*",
                "/"
            );

            $indexSymbols = rand ( 0, count($symbols)-1 );

            $calcul = new Calcul();

            switch ($symbols[$indexSymbols]) {
                case "+":
                    $resultat = $firstNumber + $secondNumber;
                    break;
                case "-":
                    $resultat = $firstNumber - $secondNumber;
                    break;
                case "*" :
                    $resultat = $firstNumber * $secondNumber;
                    break;
                case "/" :
                    while($firstNumber % $secondNumber != 0){
                        $firstNumber    = rand ($minNumberRandom  , $maxNumberRandom );
                        $secondNumber   = rand ($minNumberRandom  , $maxNumberRandom );
                    }

                    $resultat = $firstNumber / $secondNumber;
                    break;
            }

            $calcul->setLibelle($correspondenceArray[$firstNumber-1] . " " . $symbols[$indexSymbols] . " " . $correspondenceArray[$secondNumber-1]);
            $calcul->setResultat($resultat);

            $entityManager->persist($calcul);
        }
        $entityManager->flush();
    }
}
