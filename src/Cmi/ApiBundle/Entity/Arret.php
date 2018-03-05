<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Arret
 *
 * @ORM\Table(name="arret")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\ArretRepository")
 */
class Arret
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"arret","accident","consultation"})
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="arret_debut", type="date")
     * @Serializer\Groups({"arret","accident","consultation"})
     */
    private $arretDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="arret_fin", type="date")
     * @Serializer\Groups({"arret","accident","consultation"})
     */
    private $arretFin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="arret_date_enreg", type="datetime")
     * @Serializer\Groups({"arret","accident","consultation"})
     */
    private $arretDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="arret_date_modif", type="datetime")
     * @Serializer\Groups({"arret","accident","consultation"})
     */
    private $arretDateModif;

    /**
     * @ORM\ManyToOne(targetEntity="AccidentTravail", inversedBy="arrets")
     * @var AccidentTravail
     * @Serializer\Groups({"arret"})
     */
    private $accident;

    /**
     * @ORM\ManyToOne(targetEntity="Consultation", inversedBy="arrets")
     * @var Consultation
     * @Serializer\Groups({"arret"})
     */
    private $consultation;


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
     * Set arDebut
     *
     * @param \DateTime $arretDebut
     *
     * @return Arret
     */
    public function setArretDebut($arretDebut)
    {
        $this->arretDebut = $arretDebut;

        return $this;
    }

    /**
     * Get arDebut
     *
     * @return \DateTime
     */
    public function getArretDebut()
    {
        return $this->arretDebut;
    }

    /**
     * Set arFin
     *
     * @param \DateTime $arretFin
     *
     * @return Arret
     */
    public function setArretFin($arretFin)
    {
        $this->arretFin = $arretFin;

        return $this;
    }

    /**
     * Get arFin
     *
     * @return \DateTime
     */
    public function getArretFin()
    {
        return $this->arretFin;
    }

    /**
     * Set arDateEnreg
     *
     * @param \DateTime $arretDateEnreg
     *
     * @return Arret
     */
    public function setArretDateEnreg($arretDateEnreg)
    {
        $this->arretDateEnreg = $arretDateEnreg;

        return $this;
    }

    /**
     * Get arDateEnreg
     *
     * @return \DateTime
     */
    public function getArretDateEnreg()
    {
        return $this->arretDateEnreg;
    } 

    /**
     * Set arDateModif
     *
     * @param \DateTime $arretDateModif
     *
     * @return Arret
     */
    public function setArretDateModif($arretDateModif)
    {
        $this->arretDateModif = $arretDateModif;

        return $this;
    }

    /**
     * Get arDateModif
     *
     * @return \DateTime
     */
    public function getArretDateModif()
    {
        return $this->arretDateModif;
    }

    
    /**
     * Set consultation
     *
     * @param \Cmi\ApiBundle\Entity\Consultation $consultation
     *
     * @return Arret
     */
    public function setConsultation(\Cmi\ApiBundle\Entity\Consultation $consultation = null)
    {
        $this->consultation = $consultation;

        return $this;
    }

    /**
     * Get consultation
     *
     * @return \Cmi\ApiBundle\Entity\Consultation
     */
    public function getConsultation()
    {
        return $this->consultation;
    }

    /**
     * Set accident
     *
     * @param \Cmi\ApiBundle\Entity\AccidentTravail $accident
     *
     * @return Arret
     */
    public function setAccident(\Cmi\ApiBundle\Entity\AccidentTravail $accident = null)
    {
        $this->accident = $accident;

        return $this;
    }

    /**
     * Get accident
     *
     * @return \Cmi\ApiBundle\Entity\AccidentTravail
     */
    public function getAccident()
    {
        return $this->accident;
    }
}
