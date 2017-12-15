<?php

namespace Cmi\ApiBundle\Entity;
use JMS\Serializer\Annotation as Serializer;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etape
 *
 * @ORM\Table(name="etape")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\EtapeRepository")
 */
class Etape
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"consultation","etape"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="etp_code", type="string")
     * @Serializer\Groups({"consultation","etape"})
     */
    private $etp_code;

    /**
     * @var string
     *
     * @ORM\Column(name="etp_libelle", type="string", length=100)
     * @Serializer\Groups({"consultation","etape"})
     */
    private $etp_libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="etp_date_enreg", type="datetime")
     * @Serializer\Groups({"etape"})
     */
    private $etp_date_enreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="etp_date_modif", type="datetime")
     * @Serializer\Groups({"etape"})
     */
    private $etp_date_modif;

    /**
     * @ORM\OneToMany(targetEntity="Consultation", mappedBy="etape")
     * @var Consultation[]
     * @Serializer\Groups({"etape"})
     */
    private $consultations;


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
     * Set etp_code
     *
     * @param string $etp_code
     *
     * @return Etape
     */
    public function setEtpCode($etp_code)
    {
        $this->etp_code = $etp_code;

        return $this;
    }

    /**
     * Get etp_code
     *
     * @return string
     */
    public function getEtpCode()
    {
        return $this->etp_code;
    }

    /**
     * Set etp_libelle
     *
     * @param string $etp_libelle
     *
     * @return Etape
     */
    public function setEtpLibelle($etp_libelle)
    {
        $this->etp_libelle = $etp_libelle;

        return $this;
    }

    /**
     * Get etp_libelle
     *
     * @return string
     */
    public function getEtpLibelle()
    {
        return $this->etp_libelle;
    }

    /**
     * Set etp_date_enreg
     *
     * @param \DateTime $etp_date_enreg
     *
     * @return Etape
     */
    public function setEtpDateEnreg($etp_date_enreg)
    {
        $this->etp_date_enreg = $etp_date_enreg;

        return $this;
    }

    /**
     * Get etp_date_enreg
     *
     * @return \DateTime
     */
    public function getEtpDateEnreg()
    {
        return $this->etp_date_enreg;
    }

    /**
     * Set etp_date_modif
     *
     * @param \DateTime $etp_date_modif
     *
     * @return Etape
     */
    public function setEtpDateModif($etp_date_modif)
    {
        $this->etp_date_modif = $etp_date_modif;

        return $this;
    }

    /**
     * Get etp_date_modif
     *
     * @return \DateTime
     */
    public function getEtpDateModif()
    {
        return $this->etp_date_modif;
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
     * @return Etape
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
