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
            $thirdNumber    = rand ($minNumberRandom  , $maxNumberRandom );
            $fourthNumber   = rand ($minNumberRandom  , $maxNumberRandom );
            $arrayIndexSymbols = array();
            $symbols = array(
                "+",
                "-",
                "*",
                "/"
            );

            $nbNumber = rand(2,4);
            for ($i = 2; $i <= $nbNumber; $i++)
            {
                $arrayIndexSymbols[] = rand ( 0, count($symbols)-1 );
            }
            $calcul = new Calcul();
            if ($nbNumber = 2 ) {
                $libelleCalcul  = $correspondenceArray[$firstNumber-1] . " " . $arrayIndexSymbols[1] . " " . $correspondenceArray[$secondNumber-1];
                $resultatCalcul = $firstNumber . " " . $arrayIndexSymbols[1] . " " . $secondNumber;
            }
            if ($nbNumber = 3 ) {
                $libelleCalcul = $correspondenceArray[$firstNumber-1] . " " . $arrayIndexSymbols[1] . " " . $correspondenceArray[$secondNumber-1] . " " . $arrayIndexSymbols[2] . " " . $correspondenceArray[$thirdNumber-1];
                $resultatCalcul = $firstNumber . " " . $arrayIndexSymbols[1] . " " . $secondNumber . " " . $arrayIndexSymbols[2] . " " . $thirdNumber;
            }
            if ($nbNumber = 4 ) {
                $libelleCalcul = $correspondenceArray[$firstNumber-1] . " " . $arrayIndexSymbols[1] . " " . $correspondenceArray[$secondNumber-1] . " " . $arrayIndexSymbols[2] . " " . $correspondenceArray[$thirdNumber-1] . $arrayIndexSymbols[3] . " " . $correspondenceArray[$fourthNumber-1];
                $resultatCalcul = $firstNumber . " " . $arrayIndexSymbols[1] . " " . $secondNumber . " " . $arrayIndexSymbols[2] . " " . $thirdNumber . $arrayIndexSymbols[3] . " " . $fourthNumber;
            }
            $calcul->setLibelle($libelleCalcul);
            $calcul->setResultat(eval($resultatCalcul));

            $entityManager->persist($calcul);
        }
        $entityManager->flush();
    }
}
