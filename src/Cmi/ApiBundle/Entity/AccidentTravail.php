<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AccidentTravail
 *
 * @ORM\Table(name="accident_travail")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\AccidentTravailRepository")
 */
class AccidentTravail
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
     * @ORM\Column(name="at_circonstance", type="string", length=255, nullable=true)
     */
    private $atCirconstance;

    /**
     * @var string
     *
     * @ORM\Column(name="at_reference", type="string", length=100, nullable=true)
     */
    private $atReference;

    /**
     * @var int
     *
     * @ORM\Column(name="at_arret", type="integer", nullable=true)
     */
    private $atArret;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="at_date_enreg", type="datetime")
     */
    private $atDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="at_date_modif", type="datetime")
     */
    private $atDateModif;


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
     * Set atCirconstance
     *
     * @param string $atCirconstance
     *
     * @return AccidentTravail
     */
    public function setAtCirconstance($atCirconstance)
    {
        $this->atCirconstance = $atCirconstance;

        return $this;
    }

    /**
     * Get atCirconstance
     *
     * @return string
     */
    public function getAtCirconstance()
    {
        return $this->atCirconstance;
    }

    /**
     * Set atReference
     *
     * @param string $atReference
     *
     * @return AccidentTravail
     */
    public function setAtReference($atReference)
    {
        $this->atReference = $atReference;

        return $this;
    }

    /**
     * Get atReference
     *
     * @return string
     */
    public function getAtReference()
    {
        return $this->atReference;
    }

    /**
     * Set atArret
     *
     * @param integer $atArret
     *
     * @return AccidentTravail
     */
    public function setAtArret($atArret)
    {
        $this->atArret = $atArret;

        return $this;
    }

    /**
     * Get atArret
     *
     * @return int
     */
    public function getAtArret()
    {
        return $this->atArret;
    }

    /**
     * Set atDateEnreg
     *
     * @param \DateTime $atDateEnreg
     *
     * @return AccidentTravail
     */
    public function setAtDateEnreg($atDateEnreg)
    {
        $this->atDateEnreg = $atDateEnreg;

        return $this;
    }

    /**
     * Get atDateEnreg
     *
     * @return \DateTime
     */
    public function getAtDateEnreg()
    {
        return $this->atDateEnreg;
    }

    /**
     * Set atDateModif
     *
     * @param \DateTime $atDateModif
     *
     * @return AccidentTravail
     */
    public function setAtDateModif($atDateModif)
    {
        $this->atDateModif = $atDateModif;

        return $this;
    }

    /**
     * Get atDateModif
     *
     * @return \DateTime
     */
    public function getAtDateModif()
    {
        return $this->atDateModif;
    }
}
