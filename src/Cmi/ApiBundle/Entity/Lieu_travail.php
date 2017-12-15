<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Lieu_travail
 *
 * @ORM\Table(name="lieu_travail")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\Lieu_travailRepository")
 */
class Lieu_travail
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"lieu_travail","patient"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="l_trav_code", type="string", length=10)
     * @Serializer\Groups({"lieu_travail","patient"})
     */
    private $lTravCode;

    /**
     * @var string
     *
     * @ORM\Column(name="l_trav_libelle", type="string", length=100)
     * @Serializer\Groups({"lieu_travail","patient"})
     */
    private $lTravLibelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="l_trav_date_enreg", type="datetime")
     * @Serializer\Groups({"lieu_travail"})
     */
    private $lTravDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="l_trav_date_modif", type="datetime")
     * @Serializer\Groups({"lieu_travail"})
     */
    private $lTravDateModif;

    /**
     * @ORM\OneToMany(targetEntity="Patient", mappedBy="lieu_travail")
     * @var Patient[]
     * @Serializer\Groups({"lieu_travail"})
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
     * Set lTravCode
     *
     * @param string $lTravCode
     *
     * @return Lieu_travail
     */
    public function setLTravCode($lTravCode)
    {
        $this->lTravCode = $lTravCode;

        return $this;
    }

    /**
     * Get lTravCode
     *
     * @return string
     */
    public function getLTravCode()
    {
        return $this->lTravCode;
    }

    /**
     * Set lTravLibelle
     *
     * @param string $lTravLibelle
     *
     * @return Lieu_travail
     */
    public function setLTravLibelle($lTravLibelle)
    {
        $this->lTravLibelle = $lTravLibelle;

        return $this;
    }

    /**
     * Get lTravLibelle
     *
     * @return string
     */
    public function getLTravLibelle()
    {
        return $this->lTravLibelle;
    }

    /**
     * Set lTravDateEnreg
     *
     * @param \DateTime $lTravDateEnreg
     *
     * @return Lieu_travail
     */
    public function setLTravDateEnreg($lTravDateEnreg)
    {
        $this->lTravDateEnreg = $lTravDateEnreg;

        return $this;
    }

    /**
     * Get lTravDateEnreg
     *
     * @return \DateTime
     */
    public function getLTravDateEnreg()
    {
        return $this->lTravDateEnreg;
    }

    /**
     * Set lTravDateModif
     *
     * @param \DateTime $lTravDateModif
     *
     * @return Lieu_travail
     */
    public function setLTravDateModif($lTravDateModif)
    {
        $this->lTravDateModif = $lTravDateModif;

        return $this;
    }

    /**
     * Get lTravDateModif
     *
     * @return \DateTime
     */
    public function getLTravDateModif()
    {
        return $this->lTravDateModif;
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
     * @return Lieu_travail
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
