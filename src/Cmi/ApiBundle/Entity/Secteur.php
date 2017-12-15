<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Secteur
 *
 * @ORM\Table(name="secteur")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\SecteurRepository")
 */
class Secteur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"secteur","accident"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="sec_code", type="string", length=10, nullable=true)
     * @Serializer\Groups({"secteur","accident"})
     */
    private $secCode;

    /**
     * @var string
     *
     * @ORM\Column(name="sec_libelle", type="string", length=150, nullable=true)
     * @Serializer\Groups({"secteur","accident"})
     */
    private $secLibelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sec_date_enreg", type="datetime")
     * @Serializer\Groups({"secteur"})
     */
    private $secDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sec_date_modif", type="datetime")
     * @Serializer\Groups({"secteur"})
     */
    private $secDateModif;

    /**
     * @ORM\OneToMany(targetEntity="AccidentTravail", mappedBy="secteur")
     * @var Accident[]
     * @Serializer\Groups({"secteur"})
     */
    private $accidents;

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
     * Set secCode
     *
     * @param string $secCode
     *
     * @return Secteur
     */
    public function setSecCode($secCode)
    {
        $this->secCode = $secCode;

        return $this;
    }

    /**
     * Get secCode
     *
     * @return string
     */
    public function getSecCode()
    {
        return $this->secCode;
    }

    /**
     * Set secLibelle
     *
     * @param string $secLibelle
     *
     * @return Secteur
     */
    public function setSecLibelle($secLibelle)
    {
        $this->secLibelle = $secLibelle;

        return $this;
    }

    /**
     * Get secLibelle
     *
     * @return string
     */
    public function getSecLibelle()
    {
        return $this->secLibelle;
    }

    /**
     * Set secDateEnreg
     *
     * @param string $secDateEnreg
     *
     * @return Secteur
     */
    public function setSecDateEnreg($secDateEnreg)
    {
        $this->secDateEnreg = $secDateEnreg;

        return $this;
    }

    /**
     * Get secDateEnreg
     *
     * @return string
     */
    public function getSecDateEnreg()
    {
        return $this->secDateEnreg;
    }

    /**
     * Set secDateModif
     *
     * @param \DateTime $secDateModif
     *
     * @return Secteur
     */
    public function setSecDateModif($secDateModif)
    {
        $this->secDateModif = $secDateModif;

        return $this;
    }

    /**
     * Get secDateModif
     *
     * @return \DateTime
     */
    public function getSecDateModif()
    {
        return $this->secDateModif;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->accidents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add accident
     *
     * @param \Cmi\ApiBundle\Entity\AccidentTravail $accident
     *
     * @return Secteur
     */
    public function addAccident(\Cmi\ApiBundle\Entity\AccidentTravail $accident)
    {
        $this->accidents[] = $accident;

        return $this;
    }

    /**
     * Remove accident
     *
     * @param \Cmi\ApiBundle\Entity\AccidentTravail $accident
     */
    public function removeAccident(\Cmi\ApiBundle\Entity\AccidentTravail $accident)
    {
        $this->accidents->removeElement($accident);
    }

    /**
     * Get accidents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccidents()
    {
        return $this->accidents;
    }
}
