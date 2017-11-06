<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Type_patient
 *
 * @ORM\Table(name="type_patient")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\Type_patientRepository")
 */
class Type_patient
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
     * @ORM\Column(name="t_pat_code", type="string", length=20)
     */
    private $tPatCode;

    /**
     * @var string
     *
     * @ORM\Column(name="t_pat_libelle", type="string", length=100)
     */
    private $tPatLibelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="t_pat_date_enreg", type="datetime")
     */
    private $tPatDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="t_pat_date_modif", type="datetime")
     */
    private $tPatDateModif;

    /**
     * @ORM\OneToMany(targetEntity="Patient", mappedBy="type_patient")
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
     * Set tPatCode
     *
     * @param string $tPatCode
     *
     * @return Type_patient
     */
    public function setTPatCode($tPatCode)
    {
        $this->tPatCode = $tPatCode;

        return $this;
    }

    /**
     * Get tPatCode
     *
     * @return string
     */
    public function getTPatCode()
    {
        return $this->tPatCode;
    }

    /**
     * Set tPatLibelle
     *
     * @param string $tPatLibelle
     *
     * @return Type_patient
     */
    public function setTPatLibelle($tPatLibelle)
    {
        $this->tPatLibelle = $tPatLibelle;

        return $this;
    }

    /**
     * Get tPatLibelle
     *
     * @return string
     */
    public function getTPatLibelle()
    {
        return $this->tPatLibelle;
    }

    /**
     * Set tPatDateEnreg
     *
     * @param \DateTime $tPatDateEnreg
     *
     * @return Type_patient
     */
    public function setTPatDateEnreg($tPatDateEnreg)
    {
        $this->tPatDateEnreg = $tPatDateEnreg;

        return $this;
    }

    /**
     * Get tPatDateEnreg
     *
     * @return \DateTime
     */
    public function getTPatDateEnreg()
    {
        return $this->tPatDateEnreg;
    }

    /**
     * Set tPatDateModif
     *
     * @param \DateTime $tPatDateModif
     *
     * @return Type_patient
     */
    public function setTPatDateModif($tPatDateModif)
    {
        $this->tPatDateModif = $tPatDateModif;

        return $this;
    }

    /**
     * Get tPatDateModif
     *
     * @return \DateTime
     */
    public function getTPatDateModif()
    {
        return $this->tPatDateModif;
    }

    /**
     * Set patient
     *
     * @param \Cmi\ApiBundle\Entity\Patient $patient
     *
     * @return Type_patient
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
        $this->patient = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add patient
     *
     * @param \Cmi\ApiBundle\Entity\Patient $patient
     *
     * @return Type_patient
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
}
