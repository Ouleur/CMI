<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * NatureLesion
 *
 * @ORM\Table(name="nature_lesion")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\NatureLesionRepository")
 */
class NatureLesion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"naturelesion","accident"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nl_code", type="string", length=10, nullable=true)
     * @Serializer\Groups({"naturelesion","accident"})
     */
    private $nlCode;

    /**
     * @var string
     *
     * @ORM\Column(name="nl_libelle", type="string", length=150, nullable=true)
     * @Serializer\Groups({"naturelesion","accident"})
     */
    private $nlLibelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="nl_date_enreg", type="datetime")
     * @Serializer\Groups({"naturelesion"})
     */
    private $nlDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="nl_date_modif", type="datetime")
     * @Serializer\Groups({"naturelesion"})
     */
    private $nlDateModif;

    /**
     * @ORM\OneToMany(targetEntity="AccidentTravail", mappedBy="natureLesion")
     * @var Accident[]
     * @Serializer\Groups({"naturelesion"})
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
     * Set nlCode
     *
     * @param string $nlCode
     *
     * @return NatureLesion
     */
    public function setNlCode($nlCode)
    {
        $this->nlCode = $nlCode;

        return $this;
    }

    /**
     * Get nlCode
     *
     * @return string
     */
    public function getNlCode()
    {
        return $this->nlCode;
    }

    /**
     * Set nlLibelle
     *
     * @param string $nlLibelle
     *
     * @return NatureLesion
     */
    public function setNlLibelle($nlLibelle)
    {
        $this->nlLibelle = $nlLibelle;

        return $this;
    }

    /**
     * Get nlLibelle
     *
     * @return string
     */
    public function getNlLibelle()
    {
        return $this->nlLibelle;
    }

    /**
     * Set nlDateEnreg
     *
     * @param \DateTime $nlDateEnreg
     *
     * @return NatureLesion
     */
    public function setNlDateEnreg($nlDateEnreg)
    {
        $this->nlDateEnreg = $nlDateEnreg;

        return $this;
    }

    /**
     * Get nlDateEnreg
     *
     * @return \DateTime
     */
    public function getNlDateEnreg()
    {
        return $this->nlDateEnreg;
    }

    /**
     * Set nlDateModif
     *
     * @param \DateTime $nlDateModif
     *
     * @return NatureLesion
     */
    public function setNlDateModif($nlDateModif)
    {
        $this->nlDateModif = $nlDateModif;

        return $this;
    }

    /**
     * Get nlDateModif
     *
     * @return \DateTime
     */
    public function getNlDateModif()
    {
        return $this->nlDateModif;
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
     * @return NatureLesion
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
