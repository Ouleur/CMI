<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Resultat_examen
 *
 * @ORM\Table(name="resultat_examen")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\Resultat_examenRepository")
 */
class Resultat_examen
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"resultat_exam","consultation"})
     */
    private $id;


    /**
     * @var int
     *
     * @ORM\Column(name="res_etat", type="integer", nullable=true)
     * @Serializer\Groups({"resultat_exam","consultation"})
     */
    private $resEtat;

    /**
     * @var string
     *
     * @ORM\Column(name="res_observation", type="string", length=255, nullable=true)
     * @Serializer\Groups({"resultat_exam","consultation"})
     */
    private $resObservation;

    /**
     * @var string
     *
     * @ORM\Column(name="res_commentaire", type="string", length=255, nullable=true)
     * @Serializer\Groups({"resultat_exam","consultation"})
     */
    private $resCommentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="res_date_pr_fait", type="datetime", nullable=true)
     * @Serializer\Groups({"resultat_exam","consultation"})
     */
    private $resDatePrFait;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="res_date_prescrit", type="datetime", nullable=true)
     * @Serializer\Groups({"resultat_exam","consultation"})
     */
    private $resDatePrescrit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="res_date_fait", type="datetime", nullable=true)
     * @Serializer\Groups({"resultat_exam","consultation"})
     */
    private $resDateFait;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="res_date_enreg", type="datetime")
     * @Serializer\Groups({"resultat_exam"})
     */
    private $resDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="res_date_modif", type="datetime")
     * @Serializer\Groups({"resultat_exam"})
     */
    private $resDateModif;

    /**
     * @ORM\ManyToOne(targetEntity="Examen", inversedBy="resultat_examens")
     * @var Examen
     * @Serializer\Groups({"resultat_exam","consultation"})
     */
    private $examen;

    /**
     * @ORM\ManyToOne(targetEntity="Consultation", inversedBy="resultat_examens")
     * @var Consultation
     * @Serializer\Groups({"resultat_exam"})
     */
    private $consultation;

    /**
     * @ORM\ManyToOne(targetEntity="Visite", inversedBy="resultat_examens")
     * @var Visite
     * @Serializer\Groups({"resultat_exam"})
     */
    private $visite;

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
     * Set resEtat
     *
     * @param boolean $resEtat
     *
     * @return Resultat_examen
     */
    public function setResEtat($resEtat)
    {
        $this->resEtat = $resEtat;

        return $this;
    }

    /**
     * Get resEtat
     *
     * @return bool
     */
    public function getResEtat()
    {
        return $this->resEtat;
    }

    /**
     * Set resObservation
     *
     * @param string $resObservation
     *
     * @return Resultat_examen
     */
    public function setResObservation($resObservation)
    {
        $this->resObservation = $resObservation;

        return $this;
    }

    /**
     * Get resObservation
     *
     * @return string
     */
    public function getResObservation()
    {
        return $this->resObservation;
    }

    /**
     * Set resCommentaire
     *
     * @param string $resCommentaire
     *
     * @return Resultat_examen
     */
    public function setResCommentaire($resCommentaire)
    {
        $this->resCommentaire = $resCommentaire;

        return $this;
    }

    /**
     * Get resCommentaire
     *
     * @return string
     */
    public function getResCommentaire()
    {
        return $this->resCommentaire;
    }

    /**
     * Set resDateEnreg
     *
     * @param \DateTime $resDateEnreg
     *
     * @return Resultat_examen
     */
    public function setResDateEnreg($resDateEnreg)
    {
        $this->resDateEnreg = $resDateEnreg;

        return $this;
    }

    /**
     * Get resDateEnreg
     *
     * @return \DateTime
     */
    public function getResDateEnreg()
    {
        return $this->resDateEnreg;
    }

    /**
     * Set resDateModif
     *
     * @param \DateTime $resDateModif
     *
     * @return Resultat_examen
     */
    public function setResDateModif($resDateModif)
    {
        $this->resDateModif = $resDateModif;

        return $this;
    }

    /**
     * Get resDateModif
     *
     * @return \DateTime
     */
    public function getResDateModif()
    {
        return $this->resDateModif;
    }

    /**
     * Set examen
     *
     * @param \Cmi\ApiBundle\Entity\Examen $examen
     *
     * @return Resultat_examen
     */
    public function setExamen(\Cmi\ApiBundle\Entity\Examen $examen = null)
    {
        $this->examen = $examen;

        return $this;
    }

    /**
     * Get examen
     *
     * @return \Cmi\ApiBundle\Entity\Examen
     */
    public function getExamen()
    {
        return $this->examen;
    }

    /**
     * Set consultation
     *
     * @param \Cmi\ApiBundle\Entity\Consultation $consultation
     *
     * @return Resultat_examen
     */
    public function setConsultation(\Cmi\ApiBundle\Entity\Consultation $consultation = null)
    {
        $this->consultation = $consultation;

        return $this;
    }

    /**
     * Get consultation
     *
     * @return \Cmi\ApiBundle\Entity\Consultation
     */
    public function getConsultation()
    {
        return $this->consultation;
    }

    /**
     * Set resDateFait
     *
     * @param \DateTime $resDateFait
     *
     * @return Resultat_examen
     */
    public function setResDateFait($resDateFait)
    {
        $this->resDateFait = $resDateFait;

        return $this;
    }

    /**
     * Get resDateFait
     *
     * @return \DateTime
     */
    public function getResDateFait()
    {
        return $this->resDateFait;
    }

    /**
     * Set resDatePrFait
     *
     * @param \DateTime $resDatePrFait
     *
     * @return Resultat_examen
     */
    public function setResDatePrFait($resDatePrFait)
    {
        $this->resDatePrFait = $resDatePrFait;

        return $this;
    }

    /**
     * Get resDatePrFait
     *
     * @return \DateTime
     */
    public function getResDatePrFait()
    {
        return $this->resDatePrFait;
    }

    /**
     * Set resDatePrescrit
     *
     * @param \DateTime $resDatePrescrit
     *
     * @return Resultat_examen
     */
    public function setResDatePrescrit($resDatePrescrit)
    {
        $this->resDatePrescrit = $resDatePrescrit;

        return $this;
    }

    /**
     * Get resDatePrescrit
     *
     * @return \DateTime
     */
    public function getResDatePrescrit()
    {
        return $this->resDatePrescrit;
    }

    /**
     * Set visite
     *
     * @param \Cmi\ApiBundle\Entity\Visite $visite
     *
     * @return Resultat_examen
     */
    public function setVisite(\Cmi\ApiBundle\Entity\Visite $visite = null)
    {
        $this->visite = $visite;

        return $this;
    }

    /**
     * Get visite
     *
     * @return \Cmi\ApiBundle\Entity\Visite
     */
    public function getVisite()
    {
        return $this->visite;
    }
}
