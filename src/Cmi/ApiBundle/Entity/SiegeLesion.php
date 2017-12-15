<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * SiegeLesion
 *
 * @ORM\Table(name="siege_lesion")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\SiegeLesionRepository")
 */
class SiegeLesion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"siegeLesion","accident"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="sl_code", type="string", length=10, nullable=true)
     * @Serializer\Groups({"siegeLesion","accident"})
     */
    private $slCode;

    /**
     * @var string
     *
     * @ORM\Column(name="sl_libelle", type="string", length=150)
     * @Serializer\Groups({"siegeLesion","accident"})
     */
    private $slLibelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sl_date_enreg", type="datetime")
     * @Serializer\Groups({"siegeLesion"})
     */
    private $slDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sl_date_modif", type="datetime")
     * @Serializer\Groups({"siegeLesion"})
     */
    private $slDateModif;

    /**
     * @ORM\OneToMany(targetEntity="AccidentTravail", mappedBy="siegeLesion")
     * @var Accident[]
     * @Serializer\Groups({"siegeLesion"})
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
     * Set slCode
     *
     * @param string $slCode
     *
     * @return SiegeLesion
     */
    public function setSlCode($slCode)
    {
        $this->slCode = $slCode;

        return $this;
    }

    /**
     * Get slCode
     *
     * @return string
     */
    public function getSlCode()
    {
        return $this->slCode;
    }

    /**
     * Set slLibelle
     *
     * @param string $slLibelle
     *
     * @return SiegeLesion
     */
    public function setSlLibelle($slLibelle)
    {
        $this->slLibelle = $slLibelle;

        return $this;
    }

    /**
     * Get slLibelle
     *
     * @return string
     */
    public function getSlLibelle()
    {
        return $this->slLibelle;
    }

    /**
     * Set slDateEnreg
     *
     * @param \DateTime $slDateEnreg
     *
     * @return SiegeLesion
     */
    public function setSlDateEnreg($slDateEnreg)
    {
        $this->slDateEnreg = $slDateEnreg;

        return $this;
    }

    /**
     * Get slDateEnreg
     *
     * @return \DateTime
     */
    public function getSlDateEnreg()
    {
        return $this->slDateEnreg;
    }

    /**
     * Set slDateModif
     *
     * @param \DateTime $slDateModif
     *
     * @return SiegeLesion
     */
    public function setSlDateModif($slDateModif)
    {
        $this->slDateModif = $slDateModif;

        return $this;
    }

    /**
     * Get slDateModif
     *
     * @return \DateTime
     */
    public function getSlDateModif()
    {
        return $this->slDateModif;
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
     * @return SiegeLesion
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
