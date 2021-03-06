<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

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
     * @Serializer\Groups({"consultation","visite","praticien","userconected"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="prat_nom", type="string", length=100)
     * @Serializer\Groups({"consultation","visite","praticien","userconected"})
     */
    private $pratNom;

    /**
     * @var string
     *
     * @ORM\Column(name="prat_sexe", type="string", length=15)
     * @Serializer\Groups({"consultation","visite","praticien","userconected"})
     */
    private $pratSexe;

    /**
     * @var string
     *
     * @ORM\Column(name="prat_prenoms", type="string", length=150)
     * @Serializer\Groups({"consultation","visite","praticien","userconected"})
     */
    private $pratPrenoms;

    /**
     * @var string
     *
     * @ORM\Column(name="prat_contact", type="string", length=50)
     * @Serializer\Groups({"praticien"})
     */
    private $pratContact;

    /**
     * @var string
     *
     * @ORM\Column(name="prat_email", type="string", length=100)
     * @Serializer\Groups({"consultation","visite","praticien"})
     */
    private $pratEmail;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="prat_date_enreg", type="datetime")
     * @Serializer\Groups({"praticien"})
     */
    private $pratDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="prat_date_modif", type="datetime")
     * @Serializer\Groups({"praticien"})
     */
    private $pratDateModif;

    /**
     * @ORM\OneToMany(targetEntity="Consultation", mappedBy="pharmacien")
     * @var Consultation[]
     * @Serializer\Groups({"praticien"})
     */
    private $consultationsPh;

    /**
     * @ORM\OneToMany(targetEntity="Consultation", mappedBy="medecin")
     * @var Consultation[]
     * @Serializer\Groups({"praticien"})
     */
    private $consultationsMed;


    /**
     * @ORM\OneToMany(targetEntity="Consultation", mappedBy="infirmier")
     * @var Consultation[]
     * @Serializer\Groups({"praticien"})
     */
    private $consultationsInf;

    /**
     * @ORM\OneToMany(targetEntity="Visite", mappedBy="infirmier")
     * @var Visites[]
     * @Serializer\Groups({"praticien"})
     */
    private $visiteInf;

    /**
     * @ORM\OneToMany(targetEntity="Visite", mappedBy="infirmier")
     * @var Visites[]
     * @Serializer\Groups({"praticien"})
     */
    private $visiteMed;

    /**
     * @ORM\ManyToOne(targetEntity="Type_praticien", inversedBy="praticiens")
     * @var Type_praticien
     * @Serializer\Groups({"praticien","visite"})
     */
    private $type_praticien;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="praticien")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

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

    /**
     * Set typePraticien
     *
     * @param \Cmi\ApiBundle\Entity\Type_praticien $typePraticien
     *
     * @return Praticien
     */
    public function setTypePraticien(\Cmi\ApiBundle\Entity\Type_praticien $typePraticien = null)
    {
        $this->type_praticien = $typePraticien;

        return $this;
    }

    /**
     * Get typePraticien
     *
     * @return \Cmi\ApiBundle\Entity\Type_praticien
     */
    public function getTypePraticien()
    {
        return $this->type_praticien;
    }

    /**
     * Set pratSexe
     *
     * @param string $pratSexe
     *
     * @return Praticien
     */
    public function setPratSexe($pratSexe)
    {
        $this->pratSexe = $pratSexe;

        return $this;
    }

    /**
     * Get pratSexe
     *
     * @return string
     */
    public function getPratSexe()
    {
        return $this->pratSexe;
    }

    /**
     * Add visiteInf
     *
     * @param \Cmi\ApiBundle\Entity\Visite $visiteInf
     *
     * @return Praticien
     */
    public function addVisiteInf(\Cmi\ApiBundle\Entity\Visite $visiteInf)
    {
        $this->visiteInf[] = $visiteInf;

        return $this;
    }

    /**
     * Remove visiteInf
     *
     * @param \Cmi\ApiBundle\Entity\Visite $visiteInf
     */
    public function removeVisiteInf(\Cmi\ApiBundle\Entity\Visite $visiteInf)
    {
        $this->visiteInf->removeElement($visiteInf);
    }

    /**
     * Get visiteInf
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVisiteInf()
    {
        return $this->visiteInf;
    }

    /**
     * Add visiteMed
     *
     * @param \Cmi\ApiBundle\Entity\Visite $visiteMed
     *
     * @return Praticien
     */
    public function addVisiteMed(\Cmi\ApiBundle\Entity\Visite $visiteMed)
    {
        $this->visiteMed[] = $visiteMed;

        return $this;
    }

    /**
     * Remove visiteMed
     *
     * @param \Cmi\ApiBundle\Entity\Visite $visiteMed
     */
    public function removeVisiteMed(\Cmi\ApiBundle\Entity\Visite $visiteMed)
    {
        $this->visiteMed->removeElement($visiteMed);
    }

    /**
     * Get visiteMed
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVisiteMed()
    {
        return $this->visiteMed;
    }

    /**
     * Set user
     *
     * @param \Cmi\ApiBundle\Entity\User $user
     *
     * @return Praticien
     */
    public function setUser(\Cmi\ApiBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Cmi\ApiBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
