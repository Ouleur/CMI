<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * NatureAccident
 *
 * @ORM\Table(name="nature_accident")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\NatureAccidentRepository")
 */
class NatureAccident
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"natureAccident","accident"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="na_code", type="string", length=10, nullable=true)
     * @Serializer\Groups({"natureAccident","accident"})
     */
    private $naCode;

    /**
     * @var string
     *
     * @ORM\Column(name="na_libelle", type="string", length=150, nullable=true)
     * @Serializer\Groups({"natureAccident","accident"})
     */
    private $naLibelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="na_date_enreg", type="datetime")
     * @Serializer\Groups({"natureAccident"})
     */
    private $naDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="na_date_modif", type="datetime")
     * @Serializer\Groups({"natureAccident"})
     */
    private $naDateModif;

    /**
     * @ORM\OneToMany(targetEntity="AccidentTravail", mappedBy="natureAccident")
     * @var Accident[]
     * @Serializer\Groups({"natureAccident"})
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
     * Set naCode
     *
     * @param string $naCode
     *
     * @return NatureAccident
     */
    public function setNaCode($naCode)
    {
        $this->naCode = $naCode;

        return $this;
    }

    /**
     * Get naCode
     *
     * @return string
     */
    public function getNaCode()
    {
        return $this->naCode;
    }

    /**
     * Set naLibelle
     *
     * @param string $naLibelle
     *
     * @return NatureAccident
     */
    public function setNaLibelle($naLibelle)
    {
        $this->naLibelle = $naLibelle;

        return $this;
    }

    /**
     * Get naLibelle
     *
     * @return string
     */
    public function getNaLibelle()
    {
        return $this->naLibelle;
    }

    /**
     * Set naDateEnreg
     *
     * @param string $naDateEnreg
     *
     * @return NatureAccident
     */
    public function setNaDateEnreg($naDateEnreg)
    {
        $this->naDateEnreg = $naDateEnreg;

        return $this;
    }

    /**
     * Get naDateEnreg
     *
     * @return string
     */
    public function getNaDateEnreg()
    {
        return $this->naDateEnreg;
    }

    /**
     * Set naDateModif
     *
     * @param \DateTime $naDateModif
     *
     * @return NatureAccident
     */
    public function setNaDateModif($naDateModif)
    {
        $this->naDateModif = $naDateModif;

        return $this;
    }

    /**
     * Get naDateModif
     *
     * @return \DateTime
     */
    public function getNaDateModif()
    {
        return $this->naDateModif;
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
     * @return NatureAccident
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
