<?php

namespace Cmi\ApiBundle\Entity;
use JMS\Serializer\Annotation as Serializer;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\CategorieRepository")
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"patient","categorie"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="cate_code", type="string", length=10)
     * @Serializer\Groups({"patient","categorie"})
     */
    private $cateCode;

    /**
     * @var string
     *
     * @ORM\Column(name="cate_libelle", type="string", length=100)
     * @Serializer\Groups({"patient","categorie"})
     */
    private $cateLibelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cate_date_enreg", type="datetime")
     * @Serializer\Groups({"categorie"})
     */
    private $cateDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cate_date_modif", type="datetime")
     * @Serializer\Groups({"categorie"})
     */
    private $cateDateModif;

    /**
     * @ORM\OneToMany(targetEntity="Patient", mappedBy="categorie")
     * @var Patient[]
     * @Serializer\Groups({"categorie"})
     */
    private $patients;

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
     * Set cateCode
     *
     * @param string $cateCode
     *
     * @return Categorie
     */
    public function setCateCode($cateCode)
    {
        $this->cateCode = $cateCode;

        return $this;
    }

    /**
     * Get cateCode
     *
     * @return string
     */
    public function getCateCode()
    {
        return $this->cateCode;
    }

    /**
     * Set cateLibelle
     *
     * @param string $cateLibelle
     *
     * @return Categorie
     */
    public function setCateLibelle($cateLibelle)
    {
        $this->cateLibelle = $cateLibelle;

        return $this;
    }

    /**
     * Get cateLibelle
     *
     * @return string
     */
    public function getCateLibelle()
    {
        return $this->cateLibelle;
    }

    /**
     * Set cateDateEnreg
     *
     * @param \DateTime $cateDateEnreg
     *
     * @return Categorie
     */
    public function setCateDateEnreg($cateDateEnreg)
    {
        $this->cateDateEnreg = $cateDateEnreg;

        return $this;
    }

    /**
     * Get cateDateEnreg
     *
     * @return \DateTime
     */
    public function getCateDateEnreg()
    {
        return $this->cateDateEnreg;
    }

    /**
     * Set cateDateModif
     *
     * @param \DateTime $cateDateModif
     *
     * @return Categorie
     */
    public function setCateDateModif($cateDateModif)
    {
        $this->cateDateModif = $cateDateModif;

        return $this;
    }

    /**
     * Get cateDateModif
     *
     * @return \DateTime
     */
    public function getCateDateModif()
    {
        return $this->cateDateModif;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->agents = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Add patient
     *
     * @param \Cmi\ApiBundle\Entity\Patient $patient
     *
     * @return Categorie
     */
    public function addPatient(\Cmi\ApiBundle\Entity\Patient $patient)
    {
        $this->patients[] = $patient;

        return $this;
    }

    /**
     * Remove patient
     *
     * @param \Cmi\ApiBundle\Entity\Patient $patient
     */
    public function removePatient(\Cmi\ApiBundle\Entity\Patient $patient)
    {
        $this->patients->removeElement($patient);
    }

    /**
     * Get patients
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPatients()
    {
        return $this->patients;
    }
}
