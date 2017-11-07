<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="sp_id", type="integer")
     */
    private $sp_id;

    /**
     * @var string
     *
     * @ORM\Column(name="sp_code", type="string")
     */
    private $sp_code;

    /**
     * @var string
     *
     * @ORM\Column(name="sp_libelle", type="string", length=100)
     */
    private $sp_libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sp_date_enreg", type="datetime")
     */
    private $sp_date_enreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sp_date_modif", type="datetime")
     */
    private $sp_date_modif;



    /**
     * @ORM\OneToMany(targetEntity="Consultation", mappedBy="specialite")
     * @var Consultation[]
     */
    protected $consultations;


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
     * Set sp_id
     *
     * @param integer $sp_id
     *
     * @return Specialite
     */
    public function setSpecialiteId($sp_id)
    {
        $this->sp_id = $sp_id;

        return $this;
    }

    /**
     * Get sp_id
     *
     * @return int
     */
    public function getSpecialiteId()
    {
        return $this->sp_id;
    }

    /**
     * Set sp_code
     *
     * @param string $sp_code
     *
     * @return Specialite
     */
    public function setSpecialiteCode($sp_code)
    {
        $this->sp_code = $sp_code;

        return $this;
    }

    /**
     * Get sp_code
     *
     * @return string
     */
    public function getSpecialiteCode()
    {
        return $this->sp_code;
    }

    /**
     * Set sp_libelle
     *
     * @param string $sp_libelle
     *
     * @return Specialite
     */
    public function setSpecialiteLibelle($sp_libelle)
    {
        $this->sp_libelle = $sp_libelle;

        return $this;
    }

    /**
     * Get sp_libelle
     *
     * @return string
     */
    public function getSpecialiteLibelle()
    {
        return $this->sp_libelle;
    }

    /**
     * Set sp_date_enreg
     *
     * @param \DateTime $sp_date_enreg
     *
     * @return Specialite
     */
    public function setSpecialiteDateEnreg($sp_date_enreg)
    {
        $this->sp_date_enreg = $sp_date_enreg;

        return $this;
    }

    /**
     * Get sp_date_enreg
     *
     * @return \DateTime
     */
    public function getSpecialiteDateEnreg()
    {
        return $this->sp_date_enreg;
    }

    /**
     * Set sp_date_modif
     *
     * @param \DateTime $sp_date_modif
     *
     * @return Specialite
     */
    public function setSpecialiteDateModif($sp_date_modif)
    {
        $this->sp_date_modif = $sp_date_modif;

        return $this;
    }

    /**
     * Get sp_date_modif
     *
     * @return \DateTime
     */
    public function getSpecialiteDateModif()
    {
        return $this->sp_date_modif;
    }

    /**
     * Set spId
     *
     * @param integer $spId
     *
     * @return Specialite
     */
    public function setSpId($spId)
    {
        $this->sp_id = $spId;

        return $this;
    }

    /**
     * Get spId
     *
     * @return integer
     */
    public function getSpId()
    {
        return $this->sp_id;
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
     * Constructor
     */
    public function __construct()
    {
        $this->consultations = new \Doctrine\Common\Collections\ArrayCollection();
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
