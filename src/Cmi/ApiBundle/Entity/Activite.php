<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

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
     * @Serializer\Groups({"activite","accident"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="act_code", type="string", length=10)
     * @Serializer\Groups({"activite","accident"})
     */
    private $actCode;

    /**
     * @var string
     *
     * @ORM\Column(name="act_libelle", type="string", length=150, nullable=true)
     * @Serializer\Groups({"activite","accident"})
     */
    private $actLibelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="act_date_enreg", type="datetime")
     * @Serializer\Groups({"activite"})
     */
    private $actDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="act_date_modif", type="datetime")
     * @Serializer\Groups({"activite"})
     */
    private $actDateModif;

    /**
     * @ORM\OneToMany(targetEntity="AccidentTravail", mappedBy="activite")
     * @var Accident[]
     * @Serializer\Groups({"activite"})
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
     * @return Activite
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
