<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


/**
 * Consultation
 *
 * @ORM\Table(name="consultation")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\ConsultationRepository")
 */
class Consultation
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"consultation","soins"})
     */
    private $id;



    /**
     * @var \Date
     * @ORM\Column(name="cons_date", type="date",nullable=true)
     * @Serializer\Groups({"consultation","soins"})
     */
    private $cons_date;


    /**
     * @var string
     *
     * @ORM\Column(name="cons_temsion_alt", type="string",nullable=true)
     * @Serializer\Groups({"consultation","soins"})
     */
    private $cons_temsion_alt;

    /**
     * @var string
     *
     * @ORM\Column(name="cons_temperature", type="string",nullable=true)
     * @Serializer\Groups({"consultation"})
     */
    private $cons_temperature;

    /**
     * @var string
     *
     * @ORM\Column(name="cons_poids", type="string",nullable=true)
     * @Serializer\Groups({"consultation"})
     */
    private $cons_poids;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cons_rdv_date", type="date", nullable=true)
     * @Serializer\Groups({"consultation"})
     */
    private $cons_rdvDate;

    /**
     * @var string
     *
     * @ORM\Column(name="cons_rdv_objet", type="string", length=150, nullable=true)
     * @Serializer\Groups({"consultation"})
     */
    private $cons_rdvObjet;

    /**
     * @var string
     *
     * @ORM\Column(name="cons_rdv_commentaire", type="string", length=255, nullable=true)
     * @Serializer\Groups({"consultation"})
     */
    private $cons_rdvCommentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cons_date_enreg", type="datetime",nullable=true)
     * @Serializer\Groups({"consultation"})
     */
    private $cons_date_enreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cons_date_modif", type="datetime",nullable=true)
     * @Serializer\Groups({"consultation"})
     */
    private $cons_date_modif;


    /**
     * @ORM\OneToMany(targetEntity="Resultat_examen", mappedBy="consultation")
     * @var Resultat_examen[]
     * @Serializer\Groups({"consultation"})
     */
    private $resultat_examens;

    /**
     * @ORM\OneToMany(targetEntity="Soins", mappedBy="consultation")
     * @var Soins[]
     * @Serializer\Groups({"consultation"})
     */
    private $soins;

    /**
     * @ORM\ManyToOne(targetEntity="Patient", inversedBy="consultations")
     * @var Patient
     * @Serializer\Groups({"consultation"})
     */
    private $patient;


    /**
     * @ORM\ManyToOne(targetEntity="Etape", inversedBy="consultations")
     * @var Etape
     * @Serializer\Groups({"consultation"})
     */
    private $etape;

    /**
     * @ORM\ManyToOne(targetEntity="Specialite", inversedBy="consultations")
     * @var Specialite
     * @Serializer\Groups({"consultation"})
     */
    private $specialite;

    /**
     * @ORM\ManyToMany(targetEntity="Motif", cascade={"persist"})
     * @Serializer\Groups({"consultation"})
     */
    private $motifs;


    /**
     * @ORM\ManyToOne(targetEntity="Praticien", inversedBy="consultationsPh")
     * @var Praticien
     * @Serializer\Groups({"consultation"})
     */
    private $pharmacien;


    /**
     * @ORM\ManyToOne(targetEntity="Praticien", inversedBy="consultationsMed")
     * @var Praticien
     * @Serializer\Groups({"consultation"})
     */
    private $medecin;


    /**
     * @ORM\ManyToOne(targetEntity="Praticien", inversedBy="consultationsInf")
     * @var Praticien
     * @Serializer\Groups({"consultation"})
     */
    private $infirmier;


    /**
     * @ORM\OneToMany(targetEntity="Ordonnance", mappedBy="consultation")
     * @var Ordonnance[]
     * @Serializer\Groups({"consultation"})
     */
    private $ordonnances;

    /**
     * @ORM\OneToMany(targetEntity="Arret", mappedBy="consultation")
     * @var Arrets[]
     * @Serializer\Groups({"consultation"})
     */
    private $arrets;

    /**
     * @ORM\OneToMany(targetEntity="Diagnostique", mappedBy="consultation")
     * @var Diagnostique[]
     * @Serializer\Groups({"consultation"})
     */
    private $diagnostiques;

    /**
     * Get id
     *
     * @return int
     * @Serializer\Groups({"consultation"})
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cons_date_enreg
     *
     * @param \DateTime $cons_date_enreg
     *
     * @return Cons
     */
    public function setConsDateEnreg($cons_date_enreg)
    {
        $this->cons_date_enreg = $cons_date_enreg;

        return $this;
    }

    /**
     * Get cons_date_enreg
     *
     * @return \DateTime
     */
    public function getConsDateEnreg()
    {
        return $this->cons_date_enreg;
    }

    /**
     * Set cons_date_modif
     *
     * @param \DateTime $cons_date_modif
     *
     * @return Cons
     */
    public function setConsDateModif($cons_date_modif)
    {
        $this->cons_date_modif = $cons_date_modif;

        return $this;
    }

    /**
     * Get cons_date_modif
     *
     * @return \DateTime
     */
    public function getConsDateModif()
    {
        return $this->cons_date_modif;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->resultat_examens = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add resultatExamen
     *
     * @param \Cmi\ApiBundle\Entity\Resultat_examen $resultatExamen
     *
     * @return Consultation
     */
    public function addResultatExamen(\Cmi\ApiBundle\Entity\Resultat_examen $resultatExamen)
    {
        $this->resultat_examens[] = $resultatExamen;

        return $this;
    }

    /**
     * Remove resultatExamen
     *
     * @param \Cmi\ApiBundle\Entity\Resultat_examen $resultatExamen
     */
    public function removeResultatExamen(\Cmi\ApiBundle\Entity\Resultat_examen $resultatExamen)
    {
        $this->resultat_examens->removeElement($resultatExamen);
    }

    /**
     * Get resultatExamens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResultatExamens()
    {
        return $this->resultat_examens;
    }

    /**
     * Set patient
     *
     * @param \Cmi\ApiBundle\Entity\Patient $patient
     *
     * @return Consultation
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
     * Add soin
     *
     * @param \Cmi\ApiBundle\Entity\Soins $soin
     *
     * @return Consultation
     */
    public function addSoin(\Cmi\ApiBundle\Entity\Soins $soin)
    {
        $this->soins[] = $soin;

        return $this;
    }

    /**
     * Remove soin
     *
     * @param \Cmi\ApiBundle\Entity\Soins $soin
     */
    public function removeSoin(\Cmi\ApiBundle\Entity\Soins $soin)
    {
        $this->soins->removeElement($soin);
    }

    /**
     * Get soins
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSoins()
    {
        return $this->soins;
    }

    /**
     * Add motif
     *
     * @param \Cmi\ApiBundle\Entity\Motif $motif
     *
     * @return Consultation
     */
    public function addMotif(\Cmi\ApiBundle\Entity\Motif $motif)
    {
        $this->motifs[] = $motif;

        return $this;
    }

    /**
     * Remove motif
     *
     * @param \Cmi\ApiBundle\Entity\Motif $motif
     */
    public function removeMotif(\Cmi\ApiBundle\Entity\Motif $motif)
    {
        $this->motifs->removeElement($motif);
    }

    /**
     * Get motifs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMotifs()
    {
        return $this->motifs;
    }

    /**
     * Set etape
     *
     * @param \Cmi\ApiBundle\Entity\Etape $etape
     *
     * @return Consultation
     */
    public function setEtape(\Cmi\ApiBundle\Entity\Etape $etape = null)
    {
        $this->etape = $etape;

        return $this;
    }

    /**
     * Get etape
     *
     * @return \Cmi\ApiBundle\Entity\Etape
     */
    public function getEtape()
    {
        return $this->etape;
    }

    /**
     * Set specialite
     *
     * @param \Cmi\ApiBundle\Entity\Specialite $specialite
     *
     * @return Consultation
     */
    public function setSpecialite(\Cmi\ApiBundle\Entity\Specialite $specialite = null)
    {
        $this->specialite = $specialite;

        return $this;
    }

    /**
     * Get specialite
     *
     * @return \Cmi\ApiBundle\Entity\Specialite
     */
    public function getSpecialite()
    {
        return $this->specialite;
    }

    /**
     * Set pharmacien
     *
     * @param \Cmi\ApiBundle\Entity\Praticien $pharmacien
     *
     * @return Consultation
     */
    public function setPharmacien(\Cmi\ApiBundle\Entity\Praticien $pharmacien = null)
    {
        $this->pharmacien = $pharmacien;

        return $this;
    }

    /**
     * Get pharmacien
     *
     * @return \Cmi\ApiBundle\Entity\Praticien
     */
    public function getPharmacien()
    {
        return $this->pharmacien;
    }

    /**
     * Set medecin
     *
     * @param \Cmi\ApiBundle\Entity\Praticien $medecin
     *
     * @return Consultation
     */
    public function setMedecin(\Cmi\ApiBundle\Entity\Praticien $medecin = null)
    {
        $this->medecin = $medecin;

        return $this;
    }

    /**
     * Get medecin
     *
     * @return \Cmi\ApiBundle\Entity\Praticien
     */
    public function getMedecin()
    {
        return $this->medecin;
    }

    /**
     * Set infirmier
     *
     * @param \Cmi\ApiBundle\Entity\Praticien $infirmier
     *
     * @return Consultation
     */
    public function setInfirmier(\Cmi\ApiBundle\Entity\Praticien $infirmier = null)
    {
        $this->infirmier = $infirmier;

        return $this;
    }

    /**
     * Get infirmier
     *
     * @return \Cmi\ApiBundle\Entity\Praticien
     */
    public function getInfirmier()
    {
        return $this->infirmier;
    }

    /**
     * Add ordonnance
     *
     * @param \Cmi\ApiBundle\Entity\Ordonnance $ordonnance
     *
     * @return Consultation
     */
    public function addOrdonnance(\Cmi\ApiBundle\Entity\Ordonnance $ordonnance)
    {
        $this->ordonnances[] = $ordonnance;

        return $this;
    }

    /**
     * Remove ordonnance
     *
     * @param \Cmi\ApiBundle\Entity\Ordonnance $ordonnance
     */
    public function removeOrdonnance(\Cmi\ApiBundle\Entity\Ordonnance $ordonnance)
    {
        $this->ordonnances->removeElement($ordonnance);
    }

    /**
     * Get ordonnances
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrdonnances()
    {
        return $this->ordonnances;
    }

    /**
     * Add diagnostique
     *
     * @param \Cmi\ApiBundle\Entity\Diagnostique $diagnostique
     *
     * @return Consultation
     */
    public function addDiagnostique(\Cmi\ApiBundle\Entity\Diagnostique $diagnostique)
    {
        $this->diagnostiques[] = $diagnostique;

        return $this;
    }

    /**
     * Remove diagnostique
     *
     * @param \Cmi\ApiBundle\Entity\Diagnostique $diagnostique
     */
    public function removeDiagnostique(\Cmi\ApiBundle\Entity\Diagnostique $diagnostique)
    {
        $this->diagnostiques->removeElement($diagnostique);
    }

    /**
     * Get diagnostiques
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiagnostiques()
    {
        return $this->diagnostiques;
    }

    /**
     * Set consDate
     *
     * @param \DateTime $consDate
     *
     * @return Consultation
     */
    public function setConsDate($consDate)
    {
        $this->cons_date = $consDate;

        return $this;
    }

    /**
     * Get consDate
     *
     * @return \DateTime
     */
    public function getConsDate()
    {
        return $this->cons_date;
    }

    /**
     * Set consTemsionAlt
     *
     * @param string $consTemsionAlt
     *
     * @return Consultation
     */
    public function setConsTemsionAlt($consTemsionAlt)
    {
        $this->cons_temsion_alt = $consTemsionAlt;

        return $this;
    }

    /**
     * Get consTemsionAlt
     *
     * @return string
     */
    public function getConsTemsionAlt()
    {
        return $this->cons_temsion_alt;
    }

    /**
     * Set consTemperature
     *
     * @param string $consTemperature
     *
     * @return Consultation
     */
    public function setConsTemperature($consTemperature)
    {
        $this->cons_temperature = $consTemperature;

        return $this;
    }

    /**
     * Get consTemperature
     *
     * @return string
     */
    public function getConsTemperature()
    {
        return $this->cons_temperature;
    }

    /**
     * Set consPoids
     *
     * @param string $consPoids
     *
     * @return Consultation
     */
    public function setConsPoids($consPoids)
    {
        $this->cons_poids = $consPoids;

        return $this;
    }

    /**
     * Get consPoids
     *
     * @return string
     */
    public function getConsPoids()
    {
        return $this->cons_poids;
    }


    /**
     * Set consRdvDate
     *
     * @param \DateTime $consRdvDate
     *
     * @return Consultation
     */
    public function setConsRdvDate($consRdvDate)
    {
        $this->cons_rdvDate = $consRdvDate;

        return $this;
    }

    /**
     * Get consRdvDate
     *
     * @return \DateTime
     */
    public function getConsRdvDate()
    {
        return $this->cons_rdvDate;
    }

    /**
     * Set consRdvObjet
     *
     * @param string $consRdvObjet
     *
     * @return Consultation
     */
    public function setConsRdvObjet($consRdvObjet)
    {
        $this->cons_rdvObjet = $consRdvObjet;

        return $this;
    }

    /**
     * Get consRdvObjet
     *
     * @return string
     */
    public function getConsRdvObjet()
    {
        return $this->cons_rdvObjet;
    }

    /**
     * Set consRdvCommentaire
     *
     * @param string $consRdvCommentaire
     *
     * @return Consultation
     */
    public function setConsRdvCommentaire($consRdvCommentaire)
    {
        $this->cons_rdvCommentaire = $consRdvCommentaire;

        return $this;
    }

    /**
     * Get consRdvCommentaire
     *
     * @return string
     */
    public function getConsRdvCommentaire()
    {
        return $this->cons_rdvCommentaire;
    }

    /**
     * Add arret
     *
     * @param \Cmi\ApiBundle\Entity\Arret $arret
     *
     * @return Consultation
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
