<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lieu_travail
 *
 * @ORM\Table(name="lieu_travail")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\Lieu_travailRepository")
 */
class Lieu_travail
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
     * @var int
     *
     * @ORM\Column(name="l_trav_id", type="integer")
     */
    private $lTravId;

    /**
     * @var string
     *
     * @ORM\Column(name="l_trav_code", type="string", length=10)
     */
    private $lTravCode;

    /**
     * @var string
     *
     * @ORM\Column(name="l_trav_libelle", type="string", length=100)
     */
    private $lTravLibelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="l_trav_date_enreg", type="datetime")
     */
    private $lTravDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="l_trav_date_modif", type="datetime")
     */
    private $lTravDateModif;


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
     * Set lTravCode
     *
     * @param string $lTravCode
     *
     * @return Lieu_travail
     */
    public function setLTravCode($lTravCode)
    {
        $this->lTravCode = $lTravCode;

        return $this;
    }

    /**
     * Get lTravCode
     *
     * @return string
     */
    public function getLTravCode()
    {
        return $this->lTravCode;
    }

    /**
     * Set lTravLibelle
     *
     * @param string $lTravLibelle
     *
     * @return Lieu_travail
     */
    public function setLTravLibelle($lTravLibelle)
    {
        $this->lTravLibelle = $lTravLibelle;

        return $this;
    }

    /**
     * Get lTravLibelle
     *
     * @return string
     */
    public function getLTravLibelle()
    {
        return $this->lTravLibelle;
    }

    /**
     * Set lTravDateEnreg
     *
     * @param \DateTime $lTravDateEnreg
     *
     * @return Lieu_travail
     */
    public function setLTravDateEnreg($lTravDateEnreg)
    {
        $this->lTravDateEnreg = $lTravDateEnreg;

        return $this;
    }

    /**
     * Get lTravDateEnreg
     *
     * @return \DateTime
     */
    public function getLTravDateEnreg()
    {
        return $this->lTravDateEnreg;
    }

    /**
     * Set lTravDateModif
     *
     * @param \DateTime $lTravDateModif
     *
     * @return Lieu_travail
     */
    public function setLTravDateModif($lTravDateModif)
    {
        $this->lTravDateModif = $lTravDateModif;

        return $this;
    }

    /**
     * Get lTravDateModif
     *
     * @return \DateTime
     */
    public function getLTravDateModif()
    {
        return $this->lTravDateModif;
    }
}

