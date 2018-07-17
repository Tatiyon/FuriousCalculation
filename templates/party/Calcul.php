<?php
/**
 * Classe de gestion des calculs
 * User: Vincent
 * Date: 17/07/2018
 */

class Calcul
{
    var $_libelle;
    var $_resultat;
}

function generateCalcul()
{
    echo "Génère un calcul.\n";
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
        switch ($numberTypeCalculRandom) {
            CASE 1:
                $_libelle = $firstNumber + " + " + $secondNumber;
                $_resultat = $firstNumber + $secondNumber;
            CASE 2:
                $_libelle = $firstNumber + " - " + $secondNumber;
                $_resultat = $firstNumber - $secondNumber;
            CASE 3 :
                $_libelle = $firstNumber + " x " + $secondNumber;
                $_resultat = $firstNumber * $secondNumber;
            CASE 4 :
                $_libelle = $firstNumber + " / " + $secondNumber;
                $_resultat = $firstNumber / $secondNumber;
        }
        $incBoucle++;
    }

    return l;
}