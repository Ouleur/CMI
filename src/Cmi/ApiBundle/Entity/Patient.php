<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Patient
 *
 * @ORM\Table(name="patient")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\PatientRepository")
 */
class Patient
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
     * @ORM\Column(name="pat_id", type="integer")
     */
    private $patId;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_matricule", type="string", length=20, unique=true)
     */
    private $patMatricule;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_photo", type="string", length=255)
     */
    private $patPhoto;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_nom", type="string", length=50)
     */
    private $patNom;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_prenoms", type="string", length=255)
     */
    private $patPrenoms;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pat_date_naiss", type="datetime")
     */
    private $patDateNaiss;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_civilite", type="string", length=30)
     */
    private $patCivilite;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_grp_sanguin", type="string", length=5)
     */
    private $patGrpSanguin;

    /**
     * @var int
     *
     * @ORM\Column(name="pat_nbre_enfant", type="integer")
     */
    private $patNbreEnfant;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_contact", type="string", length=255)
     */
    private $patContact;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_sit_mat", type="string", length=20)
     */
    private $patSitMat;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_email", type="string", length=255, nullable=true)
     */
    private $patEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_lieu_naiss", type="string", length=100)
     */
    private $patLieuNaiss;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_loclite", type="string", length=100)
     */
    private $patLoclite;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_sexe", type="string", length=2)
     */
    private $patSexe;

    /**
     * @var int
     *
     * @ORM\Column(name="pat_cart_id", type="integer", nullable=true)
     */
    private $patCartId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pat_date_enreg", type="datetime")
     */
    private $patDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pat_date_modif", type="datetime")
     */
    private $patDateModif;


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
     * Set patMatricule
     *
     * @param string $patMatricule
     *
     * @return Patient
     */
    public function setPatMatricule($patMatricule)
    {
        $this->patMatricule = $patMatricule;

        return $this;
    }

    /**
     * Get patMatricule
     *
     * @return string
     */
    public function getPatMatricule()
    {
        return $this->patMatricule;
    }

    /**
     * Set patPhoto
     *
     * @param string $patPhoto
     *
     * @return Patient
     */
    public function setPatPhoto($patPhoto)
    {
        $this->patPhoto = $patPhoto;

        return $this;
    }

    /**
     * Get patPhoto
     *
     * @return string
     */
    public function getPatPhoto()
    {
        return $this->patPhoto;
    }

    /**
     * Set patNom
     *
     * @param string $patNom
     *
     * @return Patient
     */
    public function setPatNom($patNom)
    {
        $this->patNom = $patNom;

        return $this;
    }

    /**
     * Get patNom
     *
     * @return string
     */
    public function getPatNom()
    {
        return $this->patNom;
    }

    /**
     * Set patPrenoms
     *
     * @param string $patPrenoms
     *
     * @return Patient
     */
    public function setPatPrenoms($patPrenoms)
    {
        $this->patPrenoms = $patPrenoms;

        return $this;
    }

    /**
     * Get patPrenoms
     *
     * @return string
     */
    public function getPatPrenoms()
    {
        return $this->patPrenoms;
    }

    /**
     * Set patDateNaiss
     *
     * @param \DateTime $patDateNaiss
     *
     * @return Patient
     */
    public function setPatDateNaiss($patDateNaiss)
    {
        $this->patDateNaiss = $patDateNaiss;

        return $this;
    }

    /**
     * Get patDateNaiss
     *
     * @return \DateTime
     */
    public function getPatDateNaiss()
    {
        return $this->patDateNaiss;
    }

    /**
     * Set patCivilite
     *
     * @param string $patCivilite
     *
     * @return Patient
     */
    public function setPatCivilite($patCivilite)
    {
        $this->patCivilite = $patCivilite;

        return $this;
    }

    /**
     * Get patCivilite
     *
     * @return string
     */
    public function getPatCivilite()
    {
        return $this->patCivilite;
    }

    /**
     * Set patGrpSanguin
     *
     * @param string $patGrpSanguin
     *
     * @return Patient
     */
    public function setPatGrpSanguin($patGrpSanguin)
    {
        $this->patGrpSanguin = $patGrpSanguin;

        return $this;
    }

    /**
     * Get patGrpSanguin
     *
     * @return string
     */
    public function getPatGrpSanguin()
    {
        return $this->patGrpSanguin;
    }

    /**
     * Set patNbreEnfant
     *
     * @param integer $patNbreEnfant
     *
     * @return Patient
     */
    public function setPatNbreEnfant($patNbreEnfant)
    {
        $this->patNbreEnfant = $patNbreEnfant;

        return $this;
    }

    /**
     * Get patNbreEnfant
     *
     * @return int
     */
    public function getPatNbreEnfant()
    {
        return $this->patNbreEnfant;
    }

    /**
     * Set patContact
     *
     * @param string $patContact
     *
     * @return Patient
     */
    public function setPatContact($patContact)
    {
        $this->patContact = $patContact;

        return $this;
    }

    /**
     * Get patContact
     *
     * @return string
     */
    public function getPatContact()
    {
        return $this->patContact;
    }

    /**
     * Set patSitMat
     *
     * @param string $patSitMat
     *
     * @return Patient
     */
    public function setPatSitMat($patSitMat)
    {
        $this->patSitMat = $patSitMat;

        return $this;
    }

    /**
     * Get patSitMat
     *
     * @return string
     */
    public function getPatSitMat()
    {
        return $this->patSitMat;
    }

    /**
     * Set patEmail
     *
     * @param string $patEmail
     *
     * @return Patient
     */
    public function setPatEmail($patEmail)
    {
        $this->patEmail = $patEmail;

        return $this;
    }

    /**
     * Get patEmail
     *
     * @return string
     */
    public function getPatEmail()
    {
        return $this->patEmail;
    }

    /**
     * Set patLieuNaiss
     *
     * @param string $patLieuNaiss
     *
     * @return Patient
     */
    public function setPatLieuNaiss($patLieuNaiss)
    {
        $this->patLieuNaiss = $patLieuNaiss;

        return $this;
    }

    /**
     * Get patLieuNaiss
     *
     * @return string
     */
    public function getPatLieuNaiss()
    {
        return $this->patLieuNaiss;
    }

    /**
     * Set patLoclite
     *
     * @param string $patLoclite
     *
     * @return Patient
     */
    public function setPatLoclite($patLoclite)
    {
        $this->patLoclite = $patLoclite;

        return $this;
    }

    /**
     * Get patLoclite
     *
     * @return string
     */
    public function getPatLoclite()
    {
        return $this->patLoclite;
    }

    /**
     * Set patSexe
     *
     * @param string $patSexe
     *
     * @return Patient
     */
    public function setPatSexe($patSexe)
    {
        $this->patSexe = $patSexe;

        return $this;
    }

    /**
     * Get patSexe
     *
     * @return string
     */
    public function getPatSexe()
    {
        return $this->patSexe;
    }

    /**
     * Set patCartId
     *
     * @param integer $patCartId
     *
     * @return Patient
     */
    public function setPatCartId($patCartId)
    {
        $this->patCartId = $patCartId;

        return $this;
    }

    /**
     * Get patCartId
     *
     * @return int
     */
    public function getPatCartId()
    {
        return $this->patCartId;
    }

    /**
     * Set patDateEnreg
     *
     * @param \DateTime $patDateEnreg
     *
     * @return Patient
     */
    public function setPatDateEnreg($patDateEnreg)
    {
        $this->patDateEnreg = $patDateEnreg;

        return $this;
    }

    /**
     * Get patDateEnreg
     *
     * @return \DateTime
     */
    public function getPatDateEnreg()
    {
        return $this->patDateEnreg;
    }

    /**
     * Set patDateModif
     *
     * @param \DateTime $patDateModif
     *
     * @return Patient
     */
    public function setPatDateModif($patDateModif)
    {
        $this->patDateModif = $patDateModif;

        return $this;
    }

    /**
     * Get patDateModif
     *
     * @return \DateTime
     */
    public function getPatDateModif()
    {
        return $this->patDateModif;
    }
}

