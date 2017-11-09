<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activite
 *
 * @ORM\Table(name="activite")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\ActiviteRepository")
 */
class Activite
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
     * @ORM\Column(name="act_code", type="string", length=10)
     */
    private $actCode;

    /**
     * @var string
     *
     * @ORM\Column(name="act_libelle", type="string", length=150, nullable=true)
     */
    private $actLibelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="act_date_enreg", type="datetime")
     */
    private $actDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="act_date_modif", type="datetime")
     */
    private $actDateModif;


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
     * Set actCode
     *
     * @param string $actCode
     *
     * @return Activite
     */
    public function setActCode($actCode)
    {
        $this->actCode = $actCode;

        return $this;
    }

    /**
     * Get actCode
     *
     * @return string
     */
    public function getActCode()
    {
        return $this->actCode;
    }

    /**
     * Set actLibelle
     *
     * @param string $actLibelle
     *
     * @return Activite
     */
    public function setActLibelle($actLibelle)
    {
        $this->actLibelle = $actLibelle;

        return $this;
    }

    /**
     * Get actLibelle
     *
     * @return string
     */
    public function getActLibelle()
    {
        return $this->actLibelle;
    }

    /**
     * Set actDateEnreg
     *
     * @param \DateTime $actDateEnreg
     *
     * @return Activite
     */
    public function setActDateEnreg($actDateEnreg)
    {
        $this->actDateEnreg = $actDateEnreg;

        return $this;
    }

    /**
     * Get actDateEnreg
     *
     * @return \DateTime
     */
    public function getActDateEnreg()
    {
        return $this->actDateEnreg;
    }

    /**
     * Set actDateModif
     *
     * @param \DateTime $actDateModif
     *
     * @return Activite
     */
    public function setActDateModif($actDateModif)
    {
        $this->actDateModif = $actDateModif;

        return $this;
    }

    /**
     * Get actDateModif
     *
     * @return \DateTime
     */
    public function getActDateModif()
    {
        return $this->actDateModif;
    }
}
