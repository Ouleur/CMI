<?php

namespace Cmi\ApiBundle\Entity;

use JMS\Serializer\Annotation as Serializer;
use Doctrine\ORM\Mapping as ORM;

/**
 * Visite
 *
 * @ORM\Table(name="visite")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\VisiteRepository")
 */
class Visite
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"visite"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="vstTension", type="string", nullable=true)
     * @Serializer\Groups({"visite"})
     */
    private $vstTension;

    /**
     * @var float
     *
     * @ORM\Column(name="vstPoids", type="float", nullable=true)
     * @Serializer\Groups({"visite"})
     */
    private $vstPoids;

    /**
     * @var float
     *
     * @ORM\Column(name="vstTaille", type="float", nullable=true)
     * @Serializer\Groups({"visite"})
     */
    private $vstTaille;

    /**
     * @var int
     *
     * @ORM\Column(name="vstPouls", type="integer", nullable=true)
     * @Serializer\Groups({"visite"})
     */
    private $vstPouls;

    /**
     * @var int
     *
     * @ORM\Column(name="vstTemperature", type="integer", nullable=true)
     * @Serializer\Groups({"visite"})
     */
    private $vstTemperature;

    /**
     * @var string
     *
     * @ORM\Column(name="vstOphtamologie", type="string", length=10, nullable=true)
     * @Serializer\Groups({"visite"})
     */
    private $vstOphtamologie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vstDateEnreg", type="datetime")
     * @Serializer\Groups({"visite"})
     */
    private $vstDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vstDateModif", type="datetime")
     * @Serializer\Groups({"visite"})
     */
    private $vstDateModif;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vstDateRDV", type="date")
     * @Serializer\Groups({"visite"})
     */
    private $vstDateRDV;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vstHeureRDV", type="time")
     * @Serializer\Groups({"visite"})
     */
    private $vstHeureRDV;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vstDateFait", type="datetime")
     * @Serializer\Groups({"visite"})
     */
    private $vstDateFait;

    /**
     * @ORM\ManyToOne(targetEntity="Praticien", inversedBy="visiteMed")
     * @var Praticien
     * @Serializer\Groups({"visite"})
     */
    private $medecin;


    /**
     * @ORM\ManyToOne(targetEntity="Praticien", inversedBy="visiteInf")
     * @var Praticien
     * @Serializer\Groups({"visite"})
     */
    private $infirmier;


    /**
     * @ORM\OneToMany(targetEntity="Resultat_examen", mappedBy="visite")
     * @var Resultat_examen[]
     * @Serializer\Groups({"visite"})
     */
    private $resultat_examens;

    /**
     * @var string
     *
     * @ORM\Column(name="vstMotif", type="string", length=200, nullable=true)
     */
    private $vstMotif;

    /**
     * @ORM\ManyToMany(targetEntity="Etape", cascade={"persist"})
     * @Serializer\Groups({"visite"})
     */
    private $etape;


    /**
     * @var string
     *
     * @ORM\Column(name="vstType", type="string", length=200, nullable=true)
     */
    private $vstType;

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
     * Set vstTension
     *
     * @param integer $vstTension
     *
     * @return Visite
     */
    public function setVstTension($vstTension)
    {
        $this->vstTension = $vstTension;

        return $this;
    }

    /**
     * Get vstTension
     *
     * @return int
     */
    public function getVstTension()
    {
        return $this->vstTension;
    }

    /**
     * Set vstPoids
     *
     * @param float $vstPoids
     *
     * @return Visite
     */
    public function setVstPoids($vstPoids)
    {
        $this->vstPoids = $vstPoids;

        return $this;
    }

    /**
     * Get vstPoids
     *
     * @return float
     */
    public function getVstPoids()
    {
        return $this->vstPoids;
    }

    /**
     * Set vstTaille
     *
     * @param float $vstTaille
     *
     * @return Visite
     */
    public function setVstTaille($vstTaille)
    {
        $this->vstTaille = $vstTaille;

        return $this;
    }

    /**
     * Get vstTaille
     *
     * @return float
     */
    public function getVstTaille()
    {
        return $this->vstTaille;
    }

    /**
     * Set vstPouls
     *
     * @param integer $vstPouls
     *
     * @return Visite
     */
    public function setVstPouls($vstPouls)
    {
        $this->vstPouls = $vstPouls;

        return $this;
    }

    /**
     * Get vstPouls
     *
     * @return int
     */
    public function getVstPouls()
    {
        return $this->vstPouls;
    }

    /**
     * Set vstTemperature
     *
     * @param integer $vstTemperature
     *
     * @return Visite
     */
    public function setVstTemperature($vstTemperature)
    {
        $this->vstTemperature = $vstTemperature;

        return $this;
    }

    /**
     * Get vstTemperature
     *
     * @return int
     */
    public function getVstTemperature()
    {
        return $this->vstTemperature;
    }

    /**
     * Set vstOphtamologie
     *
     * @param string $vstOphtamologie
     *
     * @return Visite
     */
    public function setVstOphtamologie($vstOphtamologie)
    {
        $this->vstOphtamologie = $vstOphtamologie;

        return $this;
    }

    /**
     * Get vstOphtamologie
     *
     * @return string
     */
    public function getVstOphtamologie()
    {
        return $this->vstOphtamologie;
    }

    /**
     * Set vstDateEnreg
     *
     * @param \DateTime $vstDateEnreg
     *
     * @return Visite
     */
    public function setVstDateEnreg($vstDateEnreg)
    {
        $this->vstDateEnreg = $vstDateEnreg;

        return $this;
    }

    /**
     * Get vstDateEnreg
     *
     * @return \DateTime
     */
    public function getVstDateEnreg()
    {
        return $this->vstDateEnreg;
    }

    /**
     * Set vstDateModif
     *
     * @param \DateTime $vstDateModif
     *
     * @return Visite
     */
    public function setVstDateModif($vstDateModif)
    {
        $this->vstDateModif = $vstDateModif;

        return $this;
    }

    /**
     * Get vstDateModif
     *
     * @return \DateTime
     */
    public function getVstDateModif()
    {
        return $this->vstDateModif;
    }

    /**
     * Set vstDateRDV
     *
     * @param \DateTime $vstDateRDV
     *
     * @return Visite
     */
    public function setVstDateRDV($vstDateRDV)
    {
        $this->vstDateRDV = $vstDateRDV;

        return $this;
    }

    /**
     * Get vstDateRDV
     *
     * @return \DateTime
     */
    public function getVstDateRDV()
    {
        return $this->vstDateRDV;
    }

    /**
     * Set vstHeureRDV
     *
     * @param \DateTime $vstHeureRDV
     *
     * @return Visite
     */
    public function setVstHeureRDV($vstHeureRDV)
    {
        $this->vstHeureRDV = $vstHeureRDV;

        return $this;
    }

    /**
     * Get vstHeureRDV
     *
     * @return \DateTime
     */
    public function getVstHeureRDV()
    {
        return $this->vstHeureRDV;
    }

    /**
     * Set vstDateFait
     *
     * @param \DateTime $vstDateFait
     *
     * @return Visite
     */
    public function setVstDateFait($vstDateFait)
    {
        $this->vstDateFait = $vstDateFait;

        return $this;
    }

    /**
     * Get vstDateFait
     *
     * @return \DateTime
     */
    public function getVstDateFait()
    {
        return $this->vstDateFait;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->resultat_examens = new \Doctrine\Common\Collections\ArrayCollection();
        $this->etape = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set vstMotif
     *
     * @param string $vstMotif
     *
     * @return Visite
     */
    public function setVstMotif($vstMotif)
    {
        $this->vstMotif = $vstMotif;

        return $this;
    }

    /**
     * Get vstMotif
     *
     * @return string
     */
    public function getVstMotif()
    {
        return $this->vstMotif;
    }

    /**
     * Set medecin
     *
     * @param \Cmi\ApiBundle\Entity\Praticien $medecin
     *
     * @return Visite
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
     * @return Visite
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
     * Add resultatExamen
     *
     * @param \Cmi\ApiBundle\Entity\Resultat_examen $resultatExamen
     *
     * @return Visite
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
     * Add etape
     *
     * @param \Cmi\ApiBundle\Entity\Etape $etape
     *
     * @return Visite
     */
    public function addEtape(\Cmi\ApiBundle\Entity\Etape $etape)
    {
        $this->etape[] = $etape;

        return $this;
    }

    /**
     * Remove etape
     *
     * @param \Cmi\ApiBundle\Entity\Etape $etape
     */
    public function removeEtape(\Cmi\ApiBundle\Entity\Etape $etape)
    {
        $this->etape->removeElement($etape);
    }

    /**
     * Get etape
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtape()
    {
        return $this->etape;
    }

    /**
     * Set vstType
     *
     * @param string $vstType
     *
     * @return Visite
     */
    public function setVstType($vstType)
    {
        $this->vstType = $vstType;

        return $this;
    }

    /**
     * Get vstType
     *
     * @return string
     */
    public function getVstType()
    {
        return $this->vstType;
    }
}
