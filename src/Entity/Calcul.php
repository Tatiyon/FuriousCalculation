<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CalculRepository")
 */
class Calcul
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $resultat;

    public function getId()
    {
        return $this->id;
    }

    public function getLibelle()
    {
        return $this->libelle;
    }

    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getResultat()
    {
        return $this->resultat;
    }

    public function setResultat($resultat)
    {
        $this->resultat = $resultat;

        return $this;
    }
}
