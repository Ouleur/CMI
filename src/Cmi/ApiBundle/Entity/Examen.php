<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Examen
 *
 * @ORM\Table(name="examen")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\ExamenRepository")
 */
class Examen
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
     * @ORM\Column(name="exam_code", type="string", length=10, unique=true)
     */
    private $examCode;

    /**
     * @var string
     *
     * @ORM\Column(name="exam_libelle", type="string", length=100)
     */
    private $examLibelle;

    /**
     * @var int
     *
     * @ORM\Column(name="exam_type_id", type="integer")
     */
    private $examTypeId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="exam_date_enreg", type="datetime")
     */
    private $examDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="exam_date_modif", type="datetime")
     */
    private $examDateModif;


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
     * Set examCode
     *
     * @param string $examCode
     *
     * @return Examen
     */
    public function setExamCode($examCode)
    {
        $this->examCode = $examCode;

        return $this;
    }

    /**
     * Get examCode
     *
     * @return string
     */
    public function getExamCode()
    {
        return $this->examCode;
    }

    /**
     * Set examLibelle
     *
     * @param string $examLibelle
     *
     * @return Examen
     */
    public function setExamLibelle($examLibelle)
    {
        $this->examLibelle = $examLibelle;

        return $this;
    }

    /**
     * Get examLibelle
     *
     * @return string
     */
    public function getExamLibelle()
    {
        return $this->examLibelle;
    }

    /**
     * Set examTypeId
     *
     * @param integer $examTypeId
     *
     * @return Examen
     */
    public function setExamTypeId($examTypeId)
    {
        $this->examTypeId = $examTypeId;

        return $this;
    }

    /**
     * Get examTypeId
     *
     * @return int
     */
    public function getExamTypeId()
    {
        return $this->examTypeId;
    }

    /**
     * Set examDateEnreg
     *
     * @param \DateTime $examDateEnreg
     *
     * @return Examen
     */
    public function setExamDateEnreg($examDateEnreg)
    {
        $this->examDateEnreg = $examDateEnreg;

        return $this;
    }

    /**
     * Get examDateEnreg
     *
     * @return \DateTime
     */
    public function getExamDateEnreg()
    {
        return $this->examDateEnreg;
    }

    /**
     * Set examDateModif
     *
     * @param \DateTime $examDateModif
     *
     * @return Examen
     */
    public function setExamDateModif($examDateModif)
    {
        $this->examDateModif = $examDateModif;

        return $this;
    }

    /**
     * Get examDateModif
     *
     * @return \DateTime
     */
    public function getExamDateModif()
    {
        return $this->examDateModif;
    }
}
