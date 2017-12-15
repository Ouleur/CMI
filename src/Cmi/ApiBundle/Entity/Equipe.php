<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

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
     * @Serializer\Groups({"equipe","accident"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="eq_code", type="string", length=10, nullable=true)
     * @Serializer\Groups({"equipe","accident"})
     */
    private $eqCode;

    /**
     * @var string
     *
     * @ORM\Column(name="eq_libelle", type="string", length=150, nullable=true)
     * @Serializer\Groups({"equipe","accident"})
     */
    private $eqLibelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="eq_date_enreg", type="datetime")
     * @Serializer\Groups({"equipe"})
     */
    private $eqDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="eq_date_modif", type="datetime")
     * @Serializer\Groups({"equipe"})
     */
    private $eqDateModif;

    /**
     * @ORM\OneToMany(targetEntity="AccidentTravail", mappedBy="equipe")
     * @var Accident[]
     * @Serializer\Groups({"equipe"})
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
     * @return Equipe
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
