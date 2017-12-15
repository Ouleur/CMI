<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * AccidentTravail
 *
 * @ORM\Table(name="accident_travail")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\AccidentTravailRepository")
 */
class AccidentTravail
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"accident","arret"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="at_circonstance", type="string", length=255, nullable=true)
     * @Serializer\Groups({"accident","arret"})
     */
    private $atCirconstance;

    /**
     * @var string
     *
     * @ORM\Column(name="at_reference", type="string", length=100, nullable=true)
     * @Serializer\Groups({"accident","arret"})
     */
    private $atReference;

    
    /**
     * @ORM\OneToMany(targetEntity="Arret", mappedBy="accident")
     * @var Arrets[]
     * @Serializer\Groups({"accident"})
     */
    private $arrets;

    /**
     * @var Arret
     *
     * @ORM\Column(name="at_date_enreg", type="datetime")
     * @Serializer\Groups({"accident"})
     */
    private $atDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="at_date_modif", type="datetime")
     * @Serializer\Groups({"accident"})
     */
    private $atDateModif;

    /**
     * @ORM\ManyToOne(targetEntity="Equipe", inversedBy="accidents")
     * @var Equipe
     * @Serializer\Groups({"accident"})
     */
    private $equipe;

    /**
     * @ORM\ManyToOne(targetEntity="NatureLesion", inversedBy="accidents")
     * @var NatureLesion
     * @Serializer\Groups({"accident"})
     */
    private $natureLesion;

    /**
     * @ORM\ManyToOne(targetEntity="AgentMateriel", inversedBy="accidents")
     * @var AgentMateriel
     * @Serializer\Groups({"accident"})
     */
    private $agentMateriel;

    /**
     * @ORM\ManyToOne(targetEntity="Secteur", inversedBy="accidents")
     * @var Secteur
     * @Serializer\Groups({"accident"})
     */
    private $secteur;

    /**
     * @ORM\ManyToOne(targetEntity="SiegeLesion", inversedBy="accidents")
     * @var SiegeLesion
     * @Serializer\Groups({"accident"})
     */
    private $siegeLesion;

    /**
     * @ORM\ManyToOne(targetEntity="NatureAccident", inversedBy="accidents")
     * @var NatureAccident
     * @Serializer\Groups({"accident"})
     */
    private $natureAccident;

    /**
     * @ORM\ManyToOne(targetEntity="Activite", inversedBy="accidents")
     * @var Activite
     * @Serializer\Groups({"accident"})
     */
    private $activite;

    /**
     * @ORM\ManyToOne(targetEntity="Patient", inversedBy="accidents")
     * @var Patient
     * @Serializer\Groups({"accident"})
     */
    private $patient;

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
     * Set atCirconstance
     *
     * @param string $atCirconstance
     *
     * @return AccidentTravail
     */
    public function setAtCirconstance($atCirconstance)
    {
        $this->atCirconstance = $atCirconstance;

        return $this;
    }

    /**
     * Get atCirconstance
     *
     * @return string
     */
    public function getAtCirconstance()
    {
        return $this->atCirconstance;
    }

    /**
     * Set atReference
     *
     * @param string $atReference
     *
     * @return AccidentTravail
     */
    public function setAtReference($atReference)
    {
        $this->atReference = $atReference;

        return $this;
    }

    /**
     * Get atReference
     *
     * @return string
     */
    public function getAtReference()
    {
        return $this->atReference;
    }

    /**
     * Set atDateEnreg
     *
     * @param \DateTime $atDateEnreg
     *
     * @return AccidentTravail
     */
    public function setAtDateEnreg($atDateEnreg)
    {
        $this->atDateEnreg = $atDateEnreg;

        return $this;
    }

    /**
     * Get atDateEnreg
     *
     * @return \DateTime
     */
    public function getAtDateEnreg()
    {
        return $this->atDateEnreg;
    }

    /**
     * Set atDateModif
     *
     * @param \DateTime $atDateModif
     *
     * @return AccidentTravail
     */
    public function setAtDateModif($atDateModif)
    {
        $this->atDateModif = $atDateModif;

        return $this;
    }

    /**
     * Get atDateModif
     *
     * @return \DateTime
     */
    public function getAtDateModif()
    {
        return $this->atDateModif;
    }

    /**
     * Set equipe
     *
     * @param \Cmi\ApiBundle\Entity\Equipe $equipe
     *
     * @return AccidentTravail
     */
    public function setEquipe(\Cmi\ApiBundle\Entity\Equipe $equipe = null)
    {
        $this->equipe = $equipe;

        return $this;
    }

    /**
     * Get equipe
     *
     * @return \Cmi\ApiBundle\Entity\Equipe
     */
    public function getEquipe()
    {
        return $this->equipe;
    }

    /**
     * Set natureLesion
     *
     * @param \Cmi\ApiBundle\Entity\NatureLesion $natureLesion
     *
     * @return AccidentTravail
     */
    public function setNatureLesion(\Cmi\ApiBundle\Entity\NatureLesion $natureLesion = null)
    {
        $this->natureLesion = $natureLesion;

        return $this;
    }

    /**
     * Get natureLesion
     *
     * @return \Cmi\ApiBundle\Entity\NatureLesion
     */
    public function getNatureLesion()
    {
        return $this->natureLesion;
    }

    /**
     * Set agentMateriel
     *
     * @param \Cmi\ApiBundle\Entity\AgentMateriel $agentMateriel
     *
     * @return AccidentTravail
     */
    public function setAgentMateriel(\Cmi\ApiBundle\Entity\AgentMateriel $agentMateriel = null)
    {
        $this->agentMateriel = $agentMateriel;

        return $this;
    }

    /**
     * Get agentMateriel
     *
     * @return \Cmi\ApiBundle\Entity\AgentMateriel
     */
    public function getAgentMateriel()
    {
        return $this->agentMateriel;
    }

    /**
     * Set secteur
     *
     * @param \Cmi\ApiBundle\Entity\Secteur $secteur
     *
     * @return AccidentTravail
     */
    public function setSecteur(\Cmi\ApiBundle\Entity\Secteur $secteur = null)
    {
        $this->secteur = $secteur;

        return $this;
    }

    /**
     * Get secteur
     *
     * @return \Cmi\ApiBundle\Entity\Secteur
     */
    public function getSecteur()
    {
        return $this->secteur;
    }

    /**
     * Set siegeLesion
     *
     * @param \Cmi\ApiBundle\Entity\SiegeLesion $siegeLesion
     *
     * @return AccidentTravail
     */
    public function setSiegeLesion(\Cmi\ApiBundle\Entity\SiegeLesion $siegeLesion = null)
    {
        $this->siegeLesion = $siegeLesion;

        return $this;
    }

    /**
     * Get siegeLesion
     *
     * @return \Cmi\ApiBundle\Entity\SiegeLesion
     */
    public function getSiegeLesion()
    {
        return $this->siegeLesion;
    }

    /**
     * Set natureAccident
     *
     * @param \Cmi\ApiBundle\Entity\NatureAccident $natureAccident
     *
     * @return AccidentTravail
     */
    public function setNatureAccident(\Cmi\ApiBundle\Entity\NatureAccident $natureAccident = null)
    {
        $this->natureAccident = $natureAccident;

        return $this;
    }

    /**
     * Get natureAccident
     *
     * @return \Cmi\ApiBundle\Entity\NatureAccident
     */
    public function getNatureAccident()
    {
        return $this->natureAccident;
    }

    /**
     * Set activite
     *
     * @param \Cmi\ApiBundle\Entity\Activite $activite
     *
     * @return AccidentTravail
     */
    public function setActivite(\Cmi\ApiBundle\Entity\Activite $activite = null)
    {
        $this->activite = $activite;

        return $this;
    }

    /**
     * Get activite
     *
     * @return \Cmi\ApiBundle\Entity\Activite
     */
    public function getActivite()
    {
        return $this->activite;
    }

    /**
     * Set patient
     *
     * @param \Cmi\ApiBundle\Entity\Patient $patient
     *
     * @return AccidentTravail
     */
    public function setPatient(\Cmi\ApiBundle\Entity\Patient $patient = null)
    {
        $this->patient = $patient;

        return $this;
    }

    /**
     * Get patient
     *
     * @return \Cmi\ApiBundle\Entity\Patient
     */
    public function getPatient()
    {
        return $this->patient;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->arrets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add arret
     *
     * @param \Cmi\ApiBundle\Entity\Arret $arret
     *
     * @return AccidentTravail
     */
    public function addArret(\Cmi\ApiBundle\Entity\Arret $arret)
    {
        $this->arrets[] = $arret;

        return $this;
    }

    /**
     * Remove arret
     *
     * @param \Cmi\ApiBundle\Entity\Arret $arret
     */
    public function removeArret(\Cmi\ApiBundle\Entity\Arret $arret)
    {
        $this->arrets->removeElement($arret);
    }

    /**
     * Get arrets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArrets()
    {
        return $this->arrets;
    }
}
