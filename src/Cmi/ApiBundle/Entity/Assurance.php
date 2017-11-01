<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Assurance
 *
 * @ORM\Table(name="assurance")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\AssuranceRepository")
 */
class Assurance
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
     * @ORM\Column(name="assure_code", type="string", length=10)
     */
    private $assureCode;

    /**
     * @var string
     *
     * @ORM\Column(name="assure_libelle", type="string", length=100)
     */
    private $assureLibelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="assure_date_enreg", type="datetime")
     */
    private $assureDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="assure_date_modif", type="datetime")
     */
    private $assureDateModif;


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
     * Set assureCode
     *
     * @param string $assureCode
     *
     * @return Assurance
     */
    public function setAssureCode($assureCode)
    {
        $this->assureCode = $assureCode;

        return $this;
    }

    /**
     * Get assureCode
     *
     * @return string
     */
    public function getAssureCode()
    {
        return $this->assureCode;
    }

    /**
     * Set assureLibelle
     *
     * @param string $assureLibelle
     *
     * @return Assurance
     */
    public function setAssureLibelle($assureLibelle)
    {
        $this->assureLibelle = $assureLibelle;

        return $this;
    }

    /**
     * Get assureLibelle
     *
     * @return string
     */
    public function getAssureLibelle()
    {
        return $this->assureLibelle;
    }

    /**
     * Set assureDateEnreg
     *
     * @param \DateTime $assureDateEnreg
     *
     * @return Assurance
     */
    public function setAssureDateEnreg($assureDateEnreg)
    {
        $this->assureDateEnreg = $assureDateEnreg;

        return $this;
    }

    /**
     * Get assureDateEnreg
     *
     * @return \DateTime
     */
    public function getAssureDateEnreg()
    {
        return $this->assureDateEnreg;
    }

    /**
     * Set assureDateModif
     *
     * @param \DateTime $assureDateModif
     *
     * @return Assurance
     */
    public function setAssureDateModif($assureDateModif)
    {
        $this->assureDateModif = $assureDateModif;

        return $this;
    }

    /**
     * Get assureDateModif
     *
     * @return \DateTime
     */
    public function getAssureDateModif()
    {
        return $this->assureDateModif;
    }
}

