<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Type_examen
 *
 * @ORM\Table(name="type_examen")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\Type_examenRepository")
 */
class Type_examen
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
     * @ORM\Column(name="t_exam_code", type="string", length=10)
     */
    private $tExamCode;

    /**
     * @var string
     *
     * @ORM\Column(name="t_exam_libelle", type="string", length=100)
     */
    private $tExamLibelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="t_exam_date_enreg", type="datetime")
     */
    private $tExamDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="t_exam_date_modif", type="datetime")
     */
    private $tExamDateModif;

    /**
     * @ORM\OneToMany(targetEntity="Examen", mappedBy="type_examen")
     * @var Examens[]
     */
    private $examens;

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
     * Set tExamCode
     *
     * @param string $tExamCode
     *
     * @return Type_examen
     */
    public function setTExamCode($tExamCode)
    {
        $this->tExamCode = $tExamCode;

        return $this;
    }

    /**
     * Get tExamCode
     *
     * @return string
     */
    public function getTExamCode()
    {
        return $this->tExamCode;
    }

    /**
     * Set tExamLibelle
     *
     * @param string $tExamLibelle
     *
     * @return Type_examen
     */
    public function setTExamLibelle($tExamLibelle)
    {
        $this->tExamLibelle = $tExamLibelle;

        return $this;
    }

    /**
     * Get tExamLibelle
     *
     * @return string
     */
    public function getTExamLibelle()
    {
        return $this->tExamLibelle;
    }

    /**
     * Set tExamDateEnreg
     *
     * @param \DateTime $tExamDateEnreg
     *
     * @return Type_examen
     */
    public function setTExamDateEnreg($tExamDateEnreg)
    {
        $this->tExamDateEnreg = $tExamDateEnreg;

        return $this;
    }

    /**
     * Get tExamDateEnreg
     *
     * @return \DateTime
     */
    public function getTExamDateEnreg()
    {
        return $this->tExamDateEnreg;
    }

    /**
     * Set tExamDateModif
     *
     * @param \DateTime $tExamDateModif
     *
     * @return Type_examen
     */
    public function setTExamDateModif($tExamDateModif)
    {
        $this->tExamDateModif = $tExamDateModif;

        return $this;
    }

    /**
     * Get tExamDateModif
     *
     * @return \DateTime
     */
    public function getTExamDateModif()
    {
        return $this->tExamDateModif;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->examens = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add examen
     *
     * @param \Cmi\ApiBundle\Entity\Examen $examen
     *
     * @return Type_examen
     */
    public function addExamen(\Cmi\ApiBundle\Entity\Examen $examen)
    {
        $this->examens[] = $examen;

        return $this;
    }

    /**
     * Remove examen
     *
     * @param \Cmi\ApiBundle\Entity\Examen $examen
     */
    public function removeExamen(\Cmi\ApiBundle\Entity\Examen $examen)
    {
        $this->examens->removeElement($examen);
    }

    /**
     * Get examens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExamens()
    {
        return $this->examens;
    }
}
