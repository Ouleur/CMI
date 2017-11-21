<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Type_contrat
 *
 * @ORM\Table(name="Type_contrat")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\Type_contratRepository")
 */
class Type_contrat
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
     * @ORM\Column(name="t_contrat_code", type="string", length=10)
     */
    private $tContratCode;

    /**
     * @var string
     *
     * @ORM\Column(name="t_contrat_libelle", type="string", length=100)
     */
    private $tContratLibelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="t_contrat_date_enreg", type="datetime")
     */
    private $tContratDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="t_contrat_date_modif", type="datetime")
     */
    private $tContratDateModif;


    /**
     * @ORM\OneToMany(targetEntity="Patient", mappedBy="type_contrat")
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
     * Set tContratCode
     *
     * @param string $tContratCode
     *
     * @return Type_contrat
     */
    public function setTContratCode($tContratCode)
    {
        $this->tContratCode = $tContratCode;

        return $this;
    }

    /**
     * Get tContratCode
     *
     * @return string
     */
    public function getTContratCode()
    {
        return $this->tContratCode;
    }

    /**
     * Set tContratLibelle
     *
     * @param string $tContratLibelle
     *
     * @return Type_contrat
     */
    public function setTContratLibelle($tContratLibelle)
    {
        $this->tContratLibelle = $tContratLibelle;

        return $this;
    }

    /**
     * Get tContratLibelle
     *
     * @return string
     */
    public function getTContratLibelle()
    {
        return $this->tContratLibelle;
    }

    /**
     * Set tContratDateEnreg
     *
     * @param \DateTime $tContratDateEnreg
     *
     * @return Type_contrat
     */
    public function setTContratDateEnreg($tContratDateEnreg)
    {
        $this->tContratDateEnreg = $tContratDateEnreg;

        return $this;
    }

    /**
     * Get tContratDateEnreg
     *
     * @return \DateTime
     */
    public function getTContratDateEnreg()
    {
        return $this->tContratDateEnreg;
    }

    /**
     * Set tContratDateModif
     *
     * @param \DateTime $tContratDateModif
     *
     * @return Type_contrat
     */
    public function setTContratDateModif($tContratDateModif)
    {
        $this->tContratDateModif = $tContratDateModif;

        return $this;
    }

    /**
     * Get tContratDateModif
     *
     * @return \DateTime
     */
    public function getTContratDateModif()
    {
        return $this->tContratDateModif;
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
     * @return Type_contrat
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
