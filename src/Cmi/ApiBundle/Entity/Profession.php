<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Profession
 *
 * @ORM\Table(name="profession")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\ProfessionRepository")
 */
class Profession
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
     * @ORM\Column(name="proff_libelle", type="string", length=255, nullable=true)
     */
    private $proffLibelle;

    /**
     * @var string
     *
     * @ORM\Column(name="proff_code", type="string", length=255, nullable=true)
     */
    private $proffCode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="proff_date_enreg", type="datetime", nullable=true)
     */
    private $proffDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="proff_date_modif", type="datetime", nullable=true)
     */
    private $proffDateModif;

    /**
     * @ORM\OneToMany(targetEntity="Patient", mappedBy="profession")
     * @var Patient[]
     */
    private $patients;

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
     * Set proffLibelle
     *
     * @param string $proffLibelle
     *
     * @return Profession
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
     * Set proffCode
     *
     * @param string $proffCode
     *
     * @return Profession
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
     * Set proffDateEnreg
     *
     * @param \DateTime $proffDateEnreg
     *
     * @return Profession
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
     * @return Profession
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
        $this->patients = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add patient
     *
     * @param \Cmi\ApiBundle\Entity\Patient $patient
     *
     * @return Profession
     */
    public function addPatient(\Cmi\ApiBundle\Entity\Patient $patient)
    {
        $this->patients[] = $patient;

        return $this;
    }

    /**
     * Remove patient
     *
     * @param \Cmi\ApiBundle\Entity\Patient $patient
     */
    public function removePatient(\Cmi\ApiBundle\Entity\Patient $patient)
    {
        $this->patients->removeElement($patient);
    }

    /**
     * Get patients
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPatients()
    {
        return $this->patients;
    }
}
