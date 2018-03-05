<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Temoin
 *
 * @ORM\Table(name="temoin")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\TemoinRepository")
 */
class Temoin
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"accident","temoin"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tem_nom", type="string", length=255, nullable=true)
     * @Serializer\Groups({"accident","temoin"})
     */
    private $temNom;

    /**
     * @var string
     *
     * @ORM\Column(name="tem_matricule", type="string", length=255, nullable=true)
     * @Serializer\Groups({"accident","temoin"})
     */
    private $temMatricule;

    /**
     * @ORM\ManyToOne(targetEntity="AccidentTravail", inversedBy="consultations")
     * @var AccidentTravail
     * @Serializer\Groups({"accident"})
     */
    private $accident;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tm_date_enreg", type="datetime")
     * @Serializer\Groups({"accident","temoin"})
     */
    private $tm_date_enreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tm_date_modif", type="datetime")
     * @Serializer\Groups({"accident","temoin"})
     */
    private $tm_date_modif;


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
     * Set temNom
     *
     * @param string $temNom
     *
     * @return Temoin
     */
    public function setTemNom($temNom)
    {
        $this->temNom = $temNom;

        return $this;
    }

    /**
     * Get temNom
     *
     * @return string
     */
    public function getTemNom()
    {
        return $this->temNom;
    }

    /**
     * Set temMatricule
     *
     * @param string $temMatricule
     *
     * @return Temoin
     */
    public function setTemMatricule($temMatricule)
    {
        $this->temMatricule = $temMatricule;

        return $this;
    }

    /**
     * Get temMatricule
     *
     * @return string
     */
    public function getTemMatricule()
    {
        return $this->temMatricule;
    }

    /**
     * Set tmDateEnreg
     *
     * @param \DateTime $tmDateEnreg
     *
     * @return Temoin
     */
    public function setTmDateEnreg($tmDateEnreg)
    {
        $this->tm_date_enreg = $tmDateEnreg;

        return $this;
    }

    /**
     * Get tmDateEnreg
     *
     * @return \DateTime
     */
    public function getTmDateEnreg()
    {
        return $this->tm_date_enreg;
    }

    /**
     * Set tmDateModif
     *
     * @param \DateTime $tmDateModif
     *
     * @return Temoin
     */
    public function setTmDateModif($tmDateModif)
    {
        $this->tm_date_modif = $tmDateModif;

        return $this;
    }

    /**
     * Get tmDateModif
     *
     * @return \DateTime
     */
    public function getTmDateModif()
    {
        return $this->tm_date_modif;
    }

    /**
     * Set accident
     *
     * @param \Cmi\ApiBundle\Entity\AccidentTravail $accident
     *
     * @return Temoin
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
