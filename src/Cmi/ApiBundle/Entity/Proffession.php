<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proffession
 *
 * @ORM\Table(name="proffession")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\ProffessionRepository")
 */
class Proffession
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="proff_code", type="string", length=10)
     */
    private $proffCode;

    /**
     * @var string
     *
     * @ORM\Column(name="proff_libelle", type="string", length=100)
     */
    private $proffLibelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="proff_date_enreg", type="datetime")
     */
    private $proffDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="proff_date_modif", type="datetime")
     */
    private $proffDateModif;

    /**
     * @ORM\OneToMany(targetEntity="Patient", mappedBy="proffession")
     * @var Patient[]
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
     * Set proffCode
     *
     * @param string $proffCode
     *
     * @return Proffession
     */
    public function setProffCode($proffCode)
    {
        $this->proffCode = $proffCode;

        return $this;
    }

    /**
     * Get proffCode
     *
     * @return string
     */
    public function getProffCode()
    {
        return $this->proffCode;
    }

    /**
     * Set proffLibelle
     *
     * @param string $proffLibelle
     *
     * @return Proffession
     */
    public function setProffLibelle($proffLibelle)
    {
        $this->proffLibelle = $proffLibelle;

        return $this;
    }

    /**
     * Get proffLibelle
     *
     * @return string
     */
    public function getProffLibelle()
    {
        return $this->proffLibelle;
    }

    /**
     * Set proffDateEnreg
     *
     * @param \DateTime $proffDateEnreg
     *
     * @return Proffession
     */
    public function setProffDateEnreg($proffDateEnreg)
    {
        $this->proffDateEnreg = $proffDateEnreg;

        return $this;
    }

    /**
     * Get proffDateEnreg
     *
     * @return \DateTime
     */
    public function getProffDateEnreg()
    {
        return $this->proffDateEnreg;
    }

    /**
     * Set proffDateModif
     *
     * @param \DateTime $proffDateModif
     *
     * @return Proffession
     */
    public function setProffDateModif($proffDateModif)
    {
        $this->proffDateModif = $proffDateModif;

        return $this;
    }

    /**
     * Get proffDateModif
     *
     * @return \DateTime
     */
    public function getProffDateModif()
    {
        return $this->proffDateModif;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->patient = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add patient
     *
     * @param \Cmi\ApiBundle\Entity\Patient $patient
     *
     * @return Proffession
     */
    public function addPatient(\Cmi\ApiBundle\Entity\Patient $patient)
    {
        $this->patient[] = $patient;

        return $this;
    }

    /**
     * Remove patient
     *
     * @param \Cmi\ApiBundle\Entity\Patient $patient
     */
    public function removePatient(\Cmi\ApiBundle\Entity\Patient $patient)
    {
        $this->patient->removeElement($patient);
    }

    /**
     * Get patient
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPatient()
    {
        return $this->patient;
    }
}
