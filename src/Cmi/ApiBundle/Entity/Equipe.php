<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipe
 *
 * @ORM\Table(name="equipe")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\EquipeRepository")
 */
class Equipe
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
     * @ORM\Column(name="eq_code", type="string", length=10, nullable=true)
     */
    private $eqCode;

    /**
     * @var string
     *
     * @ORM\Column(name="eq_libelle", type="string", length=150, nullable=true)
     */
    private $eqLibelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="eq_date_enreg", type="datetime")
     */
    private $eqDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="eq_date_modif", type="datetime")
     */
    private $eqDateModif;


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
     * Set eqCode
     *
     * @param string $eqCode
     *
     * @return Equipe
     */
    public function setEqCode($eqCode)
    {
        $this->eqCode = $eqCode;

        return $this;
    }

    /**
     * Get eqCode
     *
     * @return string
     */
    public function getEqCode()
    {
        return $this->eqCode;
    }

    /**
     * Set eqLibelle
     *
     * @param string $eqLibelle
     *
     * @return Equipe
     */
    public function setEqLibelle($eqLibelle)
    {
        $this->eqLibelle = $eqLibelle;

        return $this;
    }

    /**
     * Get eqLibelle
     *
     * @return string
     */
    public function getEqLibelle()
    {
        return $this->eqLibelle;
    }

    /**
     * Set eqDateEnreg
     *
     * @param \DateTime $eqDateEnreg
     *
     * @return Equipe
     */
    public function setEqDateEnreg($eqDateEnreg)
    {
        $this->eqDateEnreg = $eqDateEnreg;

        return $this;
    }

    /**
     * Get eqDateEnreg
     *
     * @return \DateTime
     */
    public function getEqDateEnreg()
    {
        return $this->eqDateEnreg;
    }

    /**
     * Set eqDateModif
     *
     * @param \DateTime $eqDateModif
     *
     * @return Equipe
     */
    public function setEqDateModif($eqDateModif)
    {
        $this->eqDateModif = $eqDateModif;

        return $this;
    }

    /**
     * Get eqDateModif
     *
     * @return \DateTime
     */
    public function getEqDateModif()
    {
        return $this->eqDateModif;
    }
}
