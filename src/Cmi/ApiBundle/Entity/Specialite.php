<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Specialite
 *
 * @ORM\Table(name="specialite")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\SpecialiteRepository")
 */
class Specialite
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"consultation","specialite"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="sp_code", type="string")
     * @Serializer\Groups({"consultation","specialite"})
     */
    private $sp_code;

    /**
     * @var string
     *
     * @ORM\Column(name="sp_libelle", type="string", length=100)
     * @Serializer\Groups({"consultation","specialite"})
     */
    private $sp_libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sp_date_enreg", type="datetime")
     * @Serializer\Groups({"specialite"})
     */
    private $sp_date_enreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sp_date_modif", type="datetime")
     * @Serializer\Groups({"specialite"})
     */
    private $sp_date_modif;



    /**
     * @ORM\OneToMany(targetEntity="Consultation", mappedBy="specialite")
     * @var Consultation[]
     * @Serializer\Groups({"specialite"})
     */
    private $consultations;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->consultations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set spCode
     *
     * @param string $spCode
     *
     * @return Specialite
     */
    public function setSpCode($spCode)
    {
        $this->sp_code = $spCode;

        return $this;
    }

    /**
     * Get spCode
     *
     * @return string
     */
    public function getSpCode()
    {
        return $this->sp_code;
    }

    /**
     * Set spLibelle
     *
     * @param string $spLibelle
     *
     * @return Specialite
     */
    public function setSpLibelle($spLibelle)
    {
        $this->sp_libelle = $spLibelle;

        return $this;
    }

    /**
     * Get spLibelle
     *
     * @return string
     */
    public function getSpLibelle()
    {
        return $this->sp_libelle;
    }

    /**
     * Set spDateEnreg
     *
     * @param \DateTime $spDateEnreg
     *
     * @return Specialite
     */
    public function setSpDateEnreg($spDateEnreg)
    {
        $this->sp_date_enreg = $spDateEnreg;

        return $this;
    }

    /**
     * Get spDateEnreg
     *
     * @return \DateTime
     */
    public function getSpDateEnreg()
    {
        return $this->sp_date_enreg;
    }

    /**
     * Set spDateModif
     *
     * @param \DateTime $spDateModif
     *
     * @return Specialite
     */
    public function setSpDateModif($spDateModif)
    {
        $this->sp_date_modif = $spDateModif;

        return $this;
    }

    /**
     * Get spDateModif
     *
     * @return \DateTime
     */
    public function getSpDateModif()
    {
        return $this->sp_date_modif;
    }

    /**
     * Add consultation
     *
     * @param \Cmi\ApiBundle\Entity\Consultation $consultation
     *
     * @return Specialite
     */
    public function addConsultation(\Cmi\ApiBundle\Entity\Consultation $consultation)
    {
        $this->consultations[] = $consultation;

        return $this;
    }

    /**
     * Remove consultation
     *
     * @param \Cmi\ApiBundle\Entity\Consultation $consultation
     */
    public function removeConsultation(\Cmi\ApiBundle\Entity\Consultation $consultation)
    {
        $this->consultations->removeElement($consultation);
    }

    /**
     * Get consultations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConsultations()
    {
        return $this->consultations;
    }
}
