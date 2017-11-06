<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $id;


    /**
     * @var int
     *
     * @ORM\Column(name="res_consul_id", type="integer")
     */
    private $resConsulId;

    /**
     * @var int
     *
     * @ORM\Column(name="res_exam_id", type="integer")
     */
    private $resExamId;

    /**
     * @var bool
     *
     * @ORM\Column(name="res_etat", type="boolean", nullable=true)
     */
    private $resEtat;

    /**
     * @var string
     *
     * @ORM\Column(name="res_observation", type="string", length=255, nullable=true)
     */
    private $resObservation;

    /**
     * @var string
     *
     * @ORM\Column(name="res_commentaire", type="string", length=255, nullable=true)
     */
    private $resCommentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="res_date_enreg", type="datetime")
     */
    private $resDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="res_date_modif", type="datetime")
     */
    private $resDateModif;


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
     * Set resId
     *
     * @param integer $resId
     *
     * @return Resultat_examen
     */
    public function setResId($resId)
    {
        $this->resId = $resId;

        return $this;
    }

    /**
     * Get resId
     *
     * @return int
     */
    public function getResId()
    {
        return $this->resId;
    }

    /**
     * Set resConsulId
     *
     * @param integer $resConsulId
     *
     * @return Resultat_examen
     */
    public function setResConsulId($resConsulId)
    {
        $this->resConsulId = $resConsulId;

        return $this;
    }

    /**
     * Get resConsulId
     *
     * @return int
     */
    public function getResConsulId()
    {
        return $this->resConsulId;
    }

    /**
     * Set resExamId
     *
     * @param integer $resExamId
     *
     * @return Resultat_examen
     */
    public function setResExamId($resExamId)
    {
        $this->resExamId = $resExamId;

        return $this;
    }

    /**
     * Get resExamId
     *
     * @return int
     */
    public function getResExamId()
    {
        return $this->resExamId;
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
}
