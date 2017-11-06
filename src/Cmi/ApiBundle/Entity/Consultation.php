<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Consultation
 *
 * @ORM\Table(name="consultation")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\ConsultationRepository")
 */
class Consultation
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
     * @ORM\Column(name="cons_motif_ids", type="integer")
     */
    private $cons_motif_ids;

    /**
     * @var int
     *
     * @ORM\Column(name="cons_infirmier_id", type="integer")
     */
    private $cons_infirmier_id;

    /**
     * @var int
     *
     * @ORM\Column(name="cons_specialite_id", type="integer")
     */
    private $cons_specialite_id;

    /**
     * @var int
     *
     * @ORM\Column(name="cons_medecin_id", type="integer")
     */
    private $cons_medecin_id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cons_date", type="datetime")
     */
    private $cons_date;

    /**
     * @var int
     *
     * @ORM\Column(name="cons_patient_id", type="integer")
     */
    private $cons_patient_id;

    /**
     * @var int
     *
     * @ORM\Column(name="cons_etape_id", type="integer")
     */
    private $cons_etape_id;

    /**
     * @var int
     *
     * @ORM\Column(name="cons_pharmacien_id", type="integer")
     */
    private $cons_pharmacien_id;

    /**
     * @var int
     *
     * @ORM\Column(name="cons_ordonnance_ids", type="integer")
     */
    private $cons_ordonnance_ids;

    /**
     * @var int
     *
     * @ORM\Column(name="cons_diagnost_ids", type="integer")
     */
    private $cons_diagnost_ids;

    /**
     * @var int
     *
     * @ORM\Column(name="cons_soins_ids", type="integer")
     */
    private $cons_soins_ids;

    /**
     * @var int
     *
     * @ORM\Column(name="cons_exam_res_ids", type="integer")
     */
    private $cons_exam_res_ids;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cons_date_enreg", type="datetime")
     */
    private $cons_date_enreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cons_date_modif", type="datetime")
     */
    private $cons_date_modif;


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
     * Set cons_motif_ids
     *
     * @param integer $cons_motif_ids
     *
     * @return Cons
     */
    public function setConsMotifIds($cons_motif_ids)
    {
        $this->cons_motif_ids = $cons_motif_ids;

        return $this;
    }

    /**
     * Get cons_motif_ids
     *
     * @return int
     */
    public function getConsMotifIds()
    {
        return $this->cons_motif_ids;
    }

    /**
     * Set cons_infirmier_id
     *
     * @param integer $cons_infirmier_id
     *
     * @return Consultation
     */
    public function setConsInfirmierId($cons_infirmier_id)
    {
        $this->cons_infirmier_id = $cons_infirmier_id;

        return $this;
    }

    /**
     * Get cons_infirmier_id
     *
     * @return int
     */
    public function getConsInfirmierId()
    {
        return $this->cons_infirmier_id;
    }

    /**
     * Set cons_specialite_id
     *
     * @param integer $cons_specialite_id
     *
     * @return Consultation
     */
    public function setConsSpecialiteId($cons_specialite_id)
    {
        $this->cons_specialite_id = $cons_specialite_id;

        return $this;
    }

    /**
     * Get cons_specialite_id
     *
     * @return int
     */
    public function getConsSpecialiteId()
    {
        return $this->cons_specialite_id;
    }

    /**
     * Set cons_medecin_id
     *
     * @param integer $cons_medecin_id
     *
     * @return Consultation
     */
    public function setConsMedecinId($cons_medecin_id)
    {
        $this->cons_medecin_id = $cons_medecin_id;

        return $this;
    }

    /**
     * Get cons_medecin_id
     *
     * @return int
     */
    public function getConsMedecinId()
    {
        return $this->cons_medecin_id;
    }

    /**
     * Set cons_date
     *
     * @param \DateTime $cons_date
     *
     * @return Cons
     */
    public function setConsDate($cons_date)
    {
        $this->cons_date = $cons_date;

        return $this;
    }

    /**
     * Get cons_date
     *
     * @return \DateTime
     */
    public function getConsDate()
    {
        return $this->cons_date;
    }

    /**
     * Set cons_patient_id
     *
     * @param integer $cons_patient_id
     *
     * @return Consultation
     */
    public function setConsPatientId($cons_patient_id)
    {
        $this->cons_patient_id = $cons_patient_id;

        return $this;
    }

    /**
     * Get cons_patient_id
     *
     * @return int
     */
    public function getConsPatientId()
    {
        return $this->cons_patient_id;
    }

    /**
     * Set cons_etape_id
     *
     * @param integer $cons_etape_id
     *
     * @return Consultation
     */
    public function setConsEtapeId($cons_etape_id)
    {
        $this->cons_etape_id = $cons_etape_id;

        return $this;
    }

    /**
     * Get cons_etape_id
     *
     * @return int
     */
    public function getConsEtapeId()
    {
        return $this->cons_etape_id;
    }

    /**
     * Set cons_pharmacien_id
     *
     * @param integer $cons_pharmacien_id
     *
     * @return Consultation
     */
    public function setConsPharmacienId($cons_pharmacien_id)
    {
        $this->cons_pharmacien_id = $cons_pharmacien_id;

        return $this;
    }

    /**
     * Get cons_pharmacien_id
     *
     * @return int
     */
    public function getConsPharmacienId()
    {
        return $this->cons_pharmacien_id;
    }

    /**
     * Set cons_ordonnance_ids
     *
     * @param integer $cons_ordonnance_ids
     *
     * @return Consultation
     */
    public function setConsOrdonnanceIds($cons_ordonnance_ids)
    {
        $this->cons_ordonnance_ids = $cons_ordonnance_ids;

        return $this;
    }

    /**
     * Get cons_ordonnance_ids
     *
     * @return int
     */
    public function getConsOrdonnanceIds()
    {
        return $this->cons_ordonnance_ids;
    }

    /**
     * Set cons_diagnost_ids
     *
     * @param integer $cons_diagnost_ids
     *
     * @return Consultation
     */
    public function setConsDiagnostIds($cons_diagnost_ids)
    {
        $this->cons_diagnost_ids = $cons_diagnost_ids;

        return $this;
    }

    /**
     * Get cons_diagnost_ids
     *
     * @return int
     */
    public function getConsDiagnostIds()
    {
        return $this->cons_diagnost_ids;
    }

    /**
     * Set cons_soins_ids
     *
     * @param integer $cons_soins_ids
     *
     * @return Consultation
     */
    public function setConsSoinsIds($cons_soins_ids)
    {
        $this->cons_soins_ids = $cons_soins_ids;

        return $this;
    }

    /**
     * Get cons_soins_ids
     *
     * @return int
     */
    public function getConsSoinsIds()
    {
        return $this->cons_soins_ids;
    }

    /**
     * Set cons_exam_res_ids
     *
     * @param integer $cons_exam_res_ids
     *
     * @return Consultation
     */
    public function setConsExamResIds($cons_exam_res_ids)
    {
        $this->cons_exam_res_ids = $cons_exam_res_ids;

        return $this;
    }

    /**
     * Get cons_exam_res_ids
     *
     * @return int
     */
    public function getConsExamResIds()
    {
        return $this->cons_exam_res_ids;
    }

    /**
     * Set cons_date_enreg
     *
     * @param \DateTime $cons_date_enreg
     *
     * @return Cons
     */
    public function setConsDateEnreg($cons_date_enreg)
    {
        $this->cons_date_enreg = $cons_date_enreg;

        return $this;
    }

    /**
     * Get cons_date_enreg
     *
     * @return \DateTime
     */
    public function getConsDateEnreg()
    {
        return $this->cons_date_enreg;
    }

    /**
     * Set cons_date_modif
     *
     * @param \DateTime $cons_date_modif
     *
     * @return Cons
     */
    public function setConsDateModif($cons_date_modif)
    {
        $this->cons_date_modif = $cons_date_modif;

        return $this;
    }

    /**
     * Get cons_date_modif
     *
     * @return \DateTime
     */
    public function getConsDateModif()
    {
        return $this->cons_date_modif;
    }
}
