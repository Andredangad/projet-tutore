<?php

namespace App\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Planning
 *
 * @ORM\Table(name="planning")
 * @ORM\Entity(repositoryClass="App\FrontBundle\Repository\PlanningRepository")
 */
class Planning
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="filiere", type="string", length=255)
     */
    private $filiere;

    /**
     * @var string
     *
     * @ORM\Column(name="heure", type="string", length=20, nullable=true)
     */
    private $heure;

    /**
     * @var string
     *
     * @ORM\Column(name="lundi", type="string", length=255, nullable=true)
     */
    private $lundi;

    /**
     * @var string
     *
     * @ORM\Column(name="mardi", type="string", length=255, nullable=true)
     */
    private $mardi;

    /**
     * @var string
     *
     * @ORM\Column(name="mercredi", type="string", length=255, nullable=true)
     */
    private $mercredi;

    /**
     * @var string
     *
     * @ORM\Column(name="jeudi", type="string", length=255, nullable=true)
     */
    private $jeudi;

    /**
     * @var string
     *
     * @ORM\Column(name="vendredi", type="string", length=255, nullable=true)
     */
    private $vendredi;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set filiere
     *
     * @param string $filiere
     *
     * @return Planning
     */
    public function setFiliere($filiere)
    {
        $this->filiere = $filiere;

        return $this;
    }

    /**
     * Get filiere
     *
     * @return string
     */
    public function getFiliere()
    {
        return $this->filiere;
    }

    /**
     * Set heure
     *
     * @param string $heure
     *
     * @return Planning
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;

        return $this;
    }

    /**
     * Get heure
     *
     * @return string
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * Set lundi
     *
     * @param string $lundi
     *
     * @return Planning
     */
    public function setLundi($lundi)
    {
        $this->lundi = $lundi;

        return $this;
    }

    /**
     * Get lundi
     *
     * @return string
     */
    public function getLundi()
    {
        return $this->lundi;
    }

    /**
     * Set mardi
     *
     * @param string $mardi
     *
     * @return Planning
     */
    public function setMardi($mardi)
    {
        $this->mardi = $mardi;

        return $this;
    }

    /**
     * Get mardi
     *
     * @return string
     */
    public function getMardi()
    {
        return $this->mardi;
    }

    /**
     * Set mercredi
     *
     * @param string $mercredi
     *
     * @return Planning
     */
    public function setMercredi($mercredi)
    {
        $this->mercredi = $mercredi;

        return $this;
    }

    /**
     * Get mercredi
     *
     * @return string
     */
    public function getMercredi()
    {
        return $this->mercredi;
    }

    /**
     * Set jeudi
     *
     * @param string $jeudi
     *
     * @return Planning
     */
    public function setJeudi($jeudi)
    {
        $this->jeudi = $jeudi;

        return $this;
    }

    /**
     * Get jeudi
     *
     * @return string
     */
    public function getJeudi()
    {
        return $this->jeudi;
    }

    /**
     * Set vendredi
     *
     * @param string $vendredi
     *
     * @return Planning
     */
    public function setVendredi($vendredi)
    {
        $this->vendredi = $vendredi;

        return $this;
    }

    /**
     * Get vendredi
     *
     * @return string
     */
    public function getVendredi()
    {
        return $this->vendredi;
    }
}

