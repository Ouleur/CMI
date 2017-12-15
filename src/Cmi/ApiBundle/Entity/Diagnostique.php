<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Diagnostique
 *
 * @ORM\Table(name="diagnostique")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\DiagnostiqueRepository")
 */
class Diagnostique
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"consultation","diagnostique"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="diagn_comment", type="string")
     *
    private $diagn_comment;*/

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="diagn_date_enreg", type="datetime")
     */
    private $diagn_date_enreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="diagn_date_modif", type="datetime")
     */
    private $diagn_date_modif;

    /**
     * @ORM\ManyToOne(targetEntity="Cause", inversedBy="diagnostiques")
     * @var Cause
     * @Serializer\Groups({"consultation","diagnostique"})
     */
    private $cause;

    /**
     * @ORM\ManyToOne(targetEntity="Consultation", inversedBy="diagnostiques")
     * @var Consultation
     * @Serializer\Groups({"diagnostique"})
     */
    private $consultation;

    /**
     * @ORM\ManyToOne(targetEntity="Pathologie", inversedBy="diagnostiques")
     * @var Pathologie
     * @Serializer\Groups({"consultation","diagnostique"})
     */
    private $pathologie;


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
     * Set diagn_id
     *
     * @param integer $diagn_id
     *
     * @return Diagnostique
     */
    public function setDiagnId($diagn_id)
    {
        $this->diagn_id = $diagn_id;

        return $this;
    }

    /**
     * Get diagn_id
     *
     * @return int
     */
    public function getDiagnId()
    {
        return $this->diagn_id;
    }

    /**
     * Set diagn_cause_id
     *
     * @param integer $diagn_cause_id
     *
     * @return Diagnostique
     */
    public function setDiagnCauseId($diagn_cause_id)
    {
        $this->diagn_cause_id = $diagn_cause_id;

        return $this;
    }

    /**
     * Get diagn_cause_id
     *
     * @return int
     */
    public function getDiagnCauseId()
    {
        return $this->diagn_cause_id;
    }

    /**
     * Set diagn_consul_id
     *
     * @param integer $diagn_consul_id
     *
     * @return Diagnostique
     */
    public function setDiagnConsulId($diagn_consul_id)
    {
        $this->diagn_consul_id = $diagn_consul_id;

        return $this;
    }

    /**
     * Get diagn_consul_id
     *
     * @return int
     */
    public function getDiagnConsulId()
    {
        return $this->diagn_consul_id;
    }

    /**
     * Set diagn_comment
     *
     * @param string $diagn_comment
     *
     * @return Diagnostique
     */
    public function setDiagnComment($diagn_comment)
    {
        $this->diagn_comment = $diagn_comment;

        return $this;
    }

    /**
     * Get diagn_comment
     *
     * @return string
     */
    public function getDiagnComment()
    {
        return $this->diagn_comment;
    }

    /**
     * Set diagn_date_enreg
     *
     * @param \DateTime $diagn_date_enreg
     *
     * @return Diagnostique
     */
    public function setDiagnDateEnreg($diagn_date_enreg)
    {
        $this->diagn_date_enreg = $diagn_date_enreg;

        return $this;
    }

    /**
     * Get diagn_date_enreg
     *
     * @return \DateTime
     */
    public function getDiagnDateEnreg()
    {
        return $this->diagn_date_enreg;
    }

    /**
     * Set diagn_date_modif
     *
     * @param \DateTime $diagn_date_modif
     *
     * @return Diagnostique
     */
    public function setDiagnDateModif($diagn_date_modif)
    {
        $this->diagn_date_modif = $diagn_date_modif;

        return $this;
    }

    /**
     * Get diagn_date_modif
     *
     * @return \DateTime
     */
    public function getDiagnDateModif()
    {
        return $this->diagn_date_modif;
    }

    /**
     * Set cause
     *
     * @param \Cmi\ApiBundle\Entity\Cause $cause
     *
     * @return Diagnostique
     */
    public function setCause(\Cmi\ApiBundle\Entity\Cause $cause = null)
    {
        $this->cause = $cause;

        return $this;
    }

    /**
     * Get cause
     *
     * @return \Cmi\ApiBundle\Entity\Cause
     */
    public function getCause()
    {
        return $this->cause;
    }

    /**
     * Set pathologie
     *
     * @param \Cmi\ApiBundle\Entity\Pathologie $pathologie
     *
     * @return Diagnostique
     */
    public function setPathologie(\Cmi\ApiBundle\Entity\Pathologie $pathologie = null)
    {
        $this->pathologie = $pathologie;

        return $this;
    }

    /**
     * Get pathologie
     *
     * @return \Cmi\ApiBundle\Entity\Pathologie
     */
    public function getPathologie()
    {
        return $this->pathologie;
    }

    /**
     * Set consultation
     *
     * @param \Cmi\ApiBundle\Entity\Consultation $consultation
     *
     * @return Diagnostique
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
}
