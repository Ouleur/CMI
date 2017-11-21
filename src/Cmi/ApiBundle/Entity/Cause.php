<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cause
 *
 * @ORM\Table(name="cause")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\CauseRepository")
 */
class Cause
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
     * @ORM\Column(name="cause_code", type="string")
     */
    private $cause_code;

    /**
     * @var string
     *
     * @ORM\Column(name="cause_libelle", type="string", length=100)
     */
    private $cause_libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cause_date_enreg", type="datetime")
     */
    private $cause_date_enreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cause_date_modif", type="datetime")
     */
    private $cause_date_modif;


    /**
     * @ORM\OneToMany(targetEntity="Diagnostique", mappedBy="cause")
     * @var Diagnostique[]
     */
    private $diagnostiques;


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
     * Set cause_code
     *
     * @param string $cause_code
     *
     * @return Cause
     */
    public function setCauseCode($cause_code)
    {
        $this->cause_code = $cause_code;

        return $this;
    }

    /**
     * Get cause_code
     *
     * @return string
     */
    public function getCauseCode()
    {
        return $this->cause_code;
    }

    /**
     * Set cause_libelle
     *
     * @param string $cause_libelle
     *
     * @return Cause
     */
    public function setCauseLibelle($cause_libelle)
    {
        $this->cause_libelle = $cause_libelle;

        return $this;
    }

    /**
     * Get cause_libelle
     *
     * @return string
     */
    public function getCauseLibelle()
    {
        return $this->cause_libelle;
    }

    /**
     * Set cause_date_enreg
     *
     * @param \DateTime $cause_date_enreg
     *
     * @return Cause
     */
    public function setCauseDateEnreg($cause_date_enreg)
    {
        $this->cause_date_enreg = $cause_date_enreg;

        return $this;
    }

    /**
     * Get cause_date_enreg
     *
     * @return \DateTime
     */
    public function getCauseDateEnreg()
    {
        return $this->cause_date_enreg;
    }

    /**
     * Set cause_date_modif
     *
     * @param \DateTime $cause_date_modif
     *
     * @return Cause
     */
    public function setCauseDateModif($cause_date_modif)
    {
        $this->cause_date_modif = $cause_date_modif;

        return $this;
    }

    /**
     * Get cause_date_modif
     *
     * @return \DateTime
     */
    public function getCauseDateModif()
    {
        return $this->cause_date_modif;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->diagnostiques = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add diagnostique
     *
     * @param \Cmi\ApiBundle\Entity\Diagnostique $diagnostique
     *
     * @return Cause
     */
    public function addDiagnostique(\Cmi\ApiBundle\Entity\Diagnostique $diagnostique)
    {
        $this->diagnostiques[] = $diagnostique;

        return $this;
    }

    /**
     * Remove diagnostique
     *
     * @param \Cmi\ApiBundle\Entity\Diagnostique $diagnostique
     */
    public function removeDiagnostique(\Cmi\ApiBundle\Entity\Diagnostique $diagnostique)
    {
        $this->diagnostiques->removeElement($diagnostique);
    }

    /**
     * Get diagnostiques
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiagnostiques()
    {
        return $this->diagnostiques;
    }
}
