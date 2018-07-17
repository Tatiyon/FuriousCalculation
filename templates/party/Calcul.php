<?php
/**
 * Classe de gestion des calculs
 * User: Vincent
 * Date: 17/07/2018
 */

class Calcul
{

}

/**
 * @return mixed
 */
function generateCalcul()
{
    $minTypeCalculRandom    = 1;
    $maxTypeCalculRandom    = 4;
    $minNumberRandom        = 0;
    $maxNumberRandom        = 10;
    $numberTypeCalculRandom = 0;
    $firstNumber    = 0;
    $secondNumber   = 0;
    $incBoucle = 0;

    while ($incBoucle < 40)
    {
        $firstNumber    = rand ($minNumberRandom  , $maxNumberRandom );
        $secondNumber   = rand ($minNumberRandom  , $maxNumberRandom );
        $numberTypeCalculRandom = rand ( $minTypeCalculRandom , $maxTypeCalculRandom );
        $calcul = new Calcul();
        switch ($numberTypeCalculRandom) {
            CASE 1:
                $calcul->setLibelle($firstNumber + " + " + $secondNumber);
                $calcul->setResultat($firstNumber + $secondNumber);
            CASE 2:
                $calcul->setLibelle($firstNumber + " - " + $secondNumber);
                $calcul->setResultat($firstNumber - $secondNumber);
            CASE 3 :
                $calcul->setLibelle($firstNumber + " x " + $secondNumber);
                $calcul->setResultat($firstNumber * $secondNumber);
            CASE 4 :
                $calcul->setLibelle($firstNumber + " / " + $secondNumber);
                $calcul->setResultat($firstNumber / $secondNumber);
        }
        $incBoucle++;
    }

    return l;
}