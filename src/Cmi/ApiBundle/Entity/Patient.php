<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


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
     * @Serializer\Groups({"patient","p_search","consultation","accident"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_matricule", type="string", length=255, unique=true)
     * @Serializer\Groups({"patient","p_search","consultation","accident"})
     */
    private $patMatricule;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_photo", type="string", length=255)
     * @Serializer\Groups({"patient","p_search","consultation"})
     */
    private $patPhoto;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_nom", type="string", length=50)
     * @Serializer\Groups({"patient","consultation","accident"})
     */
    private $patNom;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_prenoms", type="string", length=255)
     * @Serializer\Groups({"patient","p_search","consultation","accident"})
     */
    private $patPrenoms;

    /**
     * @var \Date
     *
     * @ORM\Column(name="pat_date_naiss", type="date")
     * @Serializer\Groups({"patient","p_search","consultation"})
     */
    private $patDateNaiss;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_civilite", type="string", length=30)
     * @Serializer\Groups({"patient","consultation"})
     */
    private $patCivilite;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_grp_sanguin", type="string", length=5)
     * @Serializer\Groups({"patient","consultation"})
     */
    private $patGrpSanguin;

    /**
     * @var int
     *
     * @ORM\Column(name="pat_nbre_enfant", type="integer")
     * @Serializer\Groups({"patient","consultation"})
     */
    private $patNbreEnfant;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_contact", type="string", length=255)
     * @Serializer\Groups({"patient","consultation"})
     */
    private $patContact;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_sit_mat", type="string", length=20)
     * @Serializer\Groups({"patient","consultation"})
     */
    private $patSitMat;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_email", type="string", length=255, nullable=true)
     * @Serializer\Groups({"patient","consultation"})
     */
    private $patEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_lieu_naiss", type="string", length=100)
     * @Serializer\Groups({"patient","consultation"})
     */
    private $patLieuNaiss;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_localite", type="string", length=100)
     * @Serializer\Groups({"patient","consultation"})
     */
    private $patLocalite;

    /**
     * @var string
     *
     * @ORM\Column(name="pat_sexe", type="string", length=2)
     * @Serializer\Groups({"patient","consultation"})
     */
    private $patSexe;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pat_date_enreg", type="datetime")
     * @Serializer\Groups({"patient"})
     */
    private $patDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pat_date_modif", type="datetime")
     * @Serializer\Groups({"patient"})
     */
    private $patDateModif;

    /**
     * @ORM\OneToMany(targetEntity="Carte", mappedBy="patient")
     * @var Carte[]
     * @Serializer\Groups({"patient","consultation"})
     */
    private $cartes;


    /**
     * @ORM\OneToMany(targetEntity="AccidentTravail", mappedBy="patient")
     * @var Accident[]
     * @Serializer\Groups({"patient","consultation"})
     */
    private $accidents;

/**
    /**
     * @ORM\ManyToOne(targetEntity="Profession", inversedBy="patient", nullable=true)
     * @var Profession
     *
    private $profession;
*/

 /**
     * @ORM\ManyToOne(targetEntity="Entite", inversedBy="patient")
     * @var Entite
     * @Serializer\Groups({"patient","consultation"})
     */
    private $entite;


     /**
     * @ORM\ManyToOne(targetEntity="Type_patient", inversedBy="patient")
     * @var Type_patient
     * @Serializer\Groups({"patient"})
     */
    private $type_patient;



    /**
     * @ORM\ManyToOne(targetEntity="Lieu_travail", inversedBy="patients")
     * @var Lieu_travail
     * @Serializer\Groups({"patient"})
     */
    private $lieu_travail;

    /**
     * @ORM\ManyToOne(targetEntity="Type_contrat", inversedBy="patient")
     * @var Type_contrat
     * @Serializer\Groups({"patient"})
     */
    private $type_contrat;

    /**
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="patient")
     * @var Categorie
     * @Serializer\Groups({"patient"})
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity="Profession", inversedBy="patient")
     * @var Proffession
     * @Serializer\Groups({"patient","consultation"})
     */
    private $profession;

    /**
     * @var string
     *
     * @ORM\Column(name="ay_droit_qualite", type="string", length=255,nullable=true)
     * @Serializer\Groups({"patient"})
     */
    private $ayDroitQualite;


    /**
     * @ORM\OneToMany(targetEntity="Consultation", mappedBy="patient")
     * @var Consultation[]
     * @Serializer\Groups({"patient"})
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
     * Constructor
     */
    public function __construct()
    {
        $this->cartes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->consultations = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return integer
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
     * Set patLocalite
     *
     * @param string $patLocalite
     *
     * @return Patient
     */
    public function setPatLocalite($patLocalite)
    {
        $this->patLocalite = $patLocalite;

        return $this;
    }

    /**
     * Get patLocalite
     *
     * @return string
     */
    public function getPatLocalite()
    {
        return $this->patLocalite;
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

    /**
     * Set ayDroitQualite
     *
     * @param string $ayDroitQualite
     *
     * @return Patient
     */
    public function setAyDroitQualite($ayDroitQualite)
    {
        $this->ayDroitQualite = $ayDroitQualite;

        return $this;
    }

    /**
     * Get ayDroitQualite
     *
     * @return string
     */
    public function getAyDroitQualite()
    {
        return $this->ayDroitQualite;
    }

    /**
     * Add carte
     *
     * @param \Cmi\ApiBundle\Entity\Carte $carte
     *
     * @return Patient
     */
    public function addCarte(\Cmi\ApiBundle\Entity\Carte $carte)
    {
        $this->cartes[] = $carte;

        return $this;
    }

    /**
     * Remove carte
     *
     * @param \Cmi\ApiBundle\Entity\Carte $carte
     */
    public function removeCarte(\Cmi\ApiBundle\Entity\Carte $carte)
    {
        $this->cartes->removeElement($carte);
    }

    /**
     * Get cartes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCartes()
    {
        return $this->cartes;
    }


    /**
     * Set entite
     *
     * @param \Cmi\ApiBundle\Entity\Entite $entite
     *
     * @return Patient
     */
    public function setEntite(\Cmi\ApiBundle\Entity\Entite $entite = null)
    {
        $this->entite = $entite;

        return $this;
    }

    /**
     * Get entite
     *
     * @return \Cmi\ApiBundle\Entity\Entite
     */
    public function getEntite()
    {
        return $this->entite;
    }


    /**
     * Set typeContrat
     *
     * @param \Cmi\ApiBundle\Entity\Type_contrat $typeContrat
     *
     * @return Patient
     */
    public function setTypeContrat(\Cmi\ApiBundle\Entity\Type_contrat $typeContrat = null)
    {
        $this->type_contrat = $typeContrat;

        return $this;
    }

    /**
     * Get typeContrat
     *
     * @return \Cmi\ApiBundle\Entity\Type_contrat
     */
    public function getTypeContrat()
    {
        return $this->type_contrat;
    }

    /**
     * Set categorie
     *
     * @param \Cmi\ApiBundle\Entity\Categorie $categorie
     *
     * @return Patient
     */
    public function setCategorie(\Cmi\ApiBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \Cmi\ApiBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Add consultation
     *
     * @param \Cmi\ApiBundle\Entity\Consultation $consultation
     *
     * @return Patient
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

    /**
     * Set typePatient
     *
     * @param \Cmi\ApiBundle\Entity\Type_patient $typePatient
     *
     * @return Patient
     */
    public function setTypePatient(\Cmi\ApiBundle\Entity\Type_patient $typePatient = null)
    {
        $this->type_patient = $typePatient;

        return $this;
    }

    /**
     * Get typePatient
     *
     * @return \Cmi\ApiBundle\Entity\Type_patient
     */
    public function getTypePatient()
    {
        return $this->type_patient;
    }

    /**
     * Set lieuTravail
     *
     * @param \Cmi\ApiBundle\Entity\Lieu_travail $lieuTravail
     *
     * @return Patient
     */
    public function setLieuTravail(\Cmi\ApiBundle\Entity\Lieu_travail $lieuTravail = null)
    {
        $this->lieu_travail = $lieuTravail;

        return $this;
    }

    /**
     * Get lieuTravail
     *
     * @return \Cmi\ApiBundle\Entity\Lieu_travail
     */
    public function getLieuTravail()
    {
        return $this->lieu_travail;
    }

    /**
     * Set profession
     *
     * @param \Cmi\ApiBundle\Entity\Profession $profession
     *
     * @return Patient
     */
    public function setProfession(\Cmi\ApiBundle\Entity\Profession $profession = null)
    {
        $this->profession = $profession;

        return $this;
    }

    /**
     * Get profession
     *
     * @return \Cmi\ApiBundle\Entity\Profession
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * Add accident
     *
     * @param \Cmi\ApiBundle\Entity\AccidentTravail $accident
     *
     * @return Patient
     */
    public function addAccident(\Cmi\ApiBundle\Entity\AccidentTravail $accident)
    {
        $this->accidents[] = $accident;

        return $this;
    }

    /**
     * Remove accident
     *
     * @param \Cmi\ApiBundle\Entity\AccidentTravail $accident
     */
    public function removeAccident(\Cmi\ApiBundle\Entity\AccidentTravail $accident)
    {
        $this->accidents->removeElement($accident);
    }

    /**
     * Get accidents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccidents()
    {
        return $this->accidents;
    }
}
