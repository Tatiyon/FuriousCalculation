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
                "*"
            );

            $nbNumber = rand(2,4);
//            $nbNumber = 2;
//            echo $nbNumber;die;

            for ($j = 2; $j <= $nbNumber; $j++)
            {
                $arrayIndexSymbols[] = rand ( 0, count($symbols)-1 );
            }

            $calcul = new Calcul();

            if(array_key_exists(0, $arrayIndexSymbols))
                $firstIndexSymbol = $arrayIndexSymbols[0];

            if(array_key_exists(1, $arrayIndexSymbols))
                $secondIndexSymbol = $arrayIndexSymbols[1];

            if(array_key_exists(2, $arrayIndexSymbols))
                $thirdIndexSymbol = $arrayIndexSymbols[2];



            if ($nbNumber == 2 ) {
                $libelleCalcul  = $correspondenceArray[$firstNumber-1] . " " .
                   $symbols[$firstIndexSymbol] . " " . $correspondenceArray[$secondNumber-1];

                $resultatCalcul = $firstNumber . " " . $symbols[$firstIndexSymbol] . " " . $secondNumber;

            }elseif ($nbNumber == 3 ) {
                $libelleCalcul = $correspondenceArray[$firstNumber-1] . " " . $symbols[$firstIndexSymbol] . " " . $correspondenceArray[$secondNumber-1] . " " .
                    $symbols[$secondIndexSymbol] . " " . $correspondenceArray[$thirdNumber-1];

                $resultatCalcul = $firstNumber . " " . $symbols[$firstIndexSymbol] . " " . $secondNumber . " " . $symbols[$secondIndexSymbol] . " " . $thirdNumber;

            }elseif ($nbNumber == 4 ) {
                $libelleCalcul = $correspondenceArray[$firstNumber-1] .
                    " " . $symbols[$firstIndexSymbol] . " " .
                    $correspondenceArray[$secondNumber-1] . " " .
                    $symbols[$secondIndexSymbol] . " " .
                    $correspondenceArray[$thirdNumber-1] . " " .
                    $symbols[$thirdIndexSymbol] . " " .
                    $correspondenceArray[$fourthNumber-1];

                $resultatCalcul = $firstNumber . " " . $symbols[$firstIndexSymbol] .
                    " " . $secondNumber . " " . $symbols[$secondIndexSymbol] .
                    " " . $thirdNumber . " " . $symbols[$thirdIndexSymbol] .
                    " " . $fourthNumber;
            }

            //DEBUG
//            echo "libelleCalcul : " . $libelleCalcul . "<br>";
//            echo "resultatCalcul : " . $resultatCalcul . "<br>";

            $calculResult = eval('return '.$resultatCalcul.';');

//            echo "calculResult : " . $calculResult . "<br><br>";

            $calcul->setLibelle($libelleCalcul);
            $calcul->setResultat($calculResult);

            $entityManager->persist($calcul);
        }
        $entityManager->flush();
    }
}
