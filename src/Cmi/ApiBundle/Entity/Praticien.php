<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Praticien
 *
 * @ORM\Table(name="praticien")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\PraticienRepository")
 */
class Praticien
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
     * @ORM\Column(name="prat_nom", type="string", length=100)
     */
    private $pratNom;

    /**
     * @var string
     *
     * @ORM\Column(name="prat_prenoms", type="string", length=150)
     */
    private $pratPrenoms;

    /**
     * @var string
     *
     * @ORM\Column(name="prat_contact", type="string", length=50)
     */
    private $pratContact;

    /**
     * @var string
     *
     * @ORM\Column(name="prat_email", type="string", length=100)
     */
    private $pratEmail;

    /**
     * @var int
     *
     * @ORM\Column(name="prat_type_id", type="integer")
     */
    private $pratTypeId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="prat_date_enreg", type="datetime")
     */
    private $pratDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="prat_date_modif", type="datetime")
     */
    private $pratDateModif;

    /**
     * @ORM\OneToMany(targetEntity="Consultation", mappedBy="consultation")
     * @var Consultation[]
     */
    protected $consultationsPh;

    /**
     * @ORM\OneToMany(targetEntity="Consultation", mappedBy="consultation")
     * @var Consultation[]
     */
    protected $consultationsMed;


    /**
     * @ORM\OneToMany(targetEntity="Consultation", mappedBy="consultation")
     * @var Consultation[]
     */
    protected $consultationsInf;


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
     * Set pratNom
     *
     * @param string $pratNom
     *
     * @return Praticien
     */
    public function setPratNom($pratNom)
    {
        $this->pratNom = $pratNom;

        return $this;
    }

    /**
     * Get pratNom
     *
     * @return string
     */
    public function getPratNom()
    {
        return $this->pratNom;
    }

    /**
     * Set pratPrenoms
     *
     * @param string $pratPrenoms
     *
     * @return Praticien
     */
    public function setPratPrenoms($pratPrenoms)
    {
        $this->pratPrenoms = $pratPrenoms;

        return $this;
    }

    /**
     * Get pratPrenoms
     *
     * @return string
     */
    public function getPratPrenoms()
    {
        return $this->pratPrenoms;
    }

    /**
     * Set pratContact
     *
     * @param string $pratContact
     *
     * @return Praticien
     */
    public function setPratContact($pratContact)
    {
        $this->pratContact = $pratContact;

        return $this;
    }

    /**
     * Get pratContact
     *
     * @return string
     */
    public function getPratContact()
    {
        return $this->pratContact;
    }

    /**
     * Set pratEmail
     *
     * @param string $pratEmail
     *
     * @return Praticien
     */
    public function setPratEmail($pratEmail)
    {
        $this->pratEmail = $pratEmail;

        return $this;
    }

    /**
     * Get pratEmail
     *
     * @return string
     */
    public function getPratEmail()
    {
        return $this->pratEmail;
    }

    /**
     * Set pratTypeId
     *
     * @param integer $pratTypeId
     *
     * @return Praticien
     */
    public function setPratTypeId($pratTypeId)
    {
        $this->pratTypeId = $pratTypeId;

        return $this;
    }

    /**
     * Get pratTypeId
     *
     * @return int
     */
    public function getPratTypeId()
    {
        return $this->pratTypeId;
    }

    /**
     * Set pratDateEnreg
     *
     * @param \DateTime $pratDateEnreg
     *
     * @return Praticien
     */
    public function setPratDateEnreg($pratDateEnreg)
    {
        $this->pratDateEnreg = $pratDateEnreg;

        return $this;
    }

    /**
     * Get pratDateEnreg
     *
     * @return \DateTime
     */
    public function getPratDateEnreg()
    {
        return $this->pratDateEnreg;
    }

    /**
     * Set pratDateModif
     *
     * @param \DateTime $pratDateModif
     *
     * @return Praticien
     */
    public function setPratDateModif($pratDateModif)
    {
        $this->pratDateModif = $pratDateModif;

        return $this;
    }

    /**
     * Get pratDateModif
     *
     * @return \DateTime
     */
    public function getPratDateModif()
    {
        return $this->pratDateModif;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->consultationsPh = new \Doctrine\Common\Collections\ArrayCollection();
        $this->consultationsMed = new \Doctrine\Common\Collections\ArrayCollection();
        $this->consultationsInf = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add consultationsPh
     *
     * @param \Cmi\ApiBundle\Entity\Consultation $consultationsPh
     *
     * @return Praticien
     */
    public function addConsultationsPh(\Cmi\ApiBundle\Entity\Consultation $consultationsPh)
    {
        $this->consultationsPh[] = $consultationsPh;

        return $this;
    }

    /**
     * Remove consultationsPh
     *
     * @param \Cmi\ApiBundle\Entity\Consultation $consultationsPh
     */
    public function removeConsultationsPh(\Cmi\ApiBundle\Entity\Consultation $consultationsPh)
    {
        $this->consultationsPh->removeElement($consultationsPh);
    }

    /**
     * Get consultationsPh
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConsultationsPh()
    {
        return $this->consultationsPh;
    }

    /**
     * Add consultationsMed
     *
     * @param \Cmi\ApiBundle\Entity\Consultation $consultationsMed
     *
     * @return Praticien
     */
    public function addConsultationsMed(\Cmi\ApiBundle\Entity\Consultation $consultationsMed)
    {
        $this->consultationsMed[] = $consultationsMed;

        return $this;
    }

    /**
     * Remove consultationsMed
     *
     * @param \Cmi\ApiBundle\Entity\Consultation $consultationsMed
     */
    public function removeConsultationsMed(\Cmi\ApiBundle\Entity\Consultation $consultationsMed)
    {
        $this->consultationsMed->removeElement($consultationsMed);
    }

    /**
     * Get consultationsMed
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConsultationsMed()
    {
        return $this->consultationsMed;
    }

    /**
     * Add consultationsInf
     *
     * @param \Cmi\ApiBundle\Entity\Consultation $consultationsInf
     *
     * @return Praticien
     */
    public function addConsultationsInf(\Cmi\ApiBundle\Entity\Consultation $consultationsInf)
    {
        $this->consultationsInf[] = $consultationsInf;

        return $this;
    }

    /**
     * Remove consultationsInf
     *
     * @param \Cmi\ApiBundle\Entity\Consultation $consultationsInf
     */
    public function removeConsultationsInf(\Cmi\ApiBundle\Entity\Consultation $consultationsInf)
    {
        $this->consultationsInf->removeElement($consultationsInf);
    }

    /**
     * Get consultationsInf
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConsultationsInf()
    {
        return $this->consultationsInf;
    }
}
