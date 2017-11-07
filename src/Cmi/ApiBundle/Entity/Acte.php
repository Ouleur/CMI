<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acte
 *
 * @ORM\Table(name="acte")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\ActeRepository")
 */
class Acte
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
     * @ORM\Column(name="acte_id", type="integer")
     */
    private $acte_id;

    /**
     * @var string
     *
     * @ORM\Column(name="acte_code", type="string")
     */
    private $acte_code;

    /**
     * @var string
     *
     * @ORM\Column(name="acte_libelle", type="string", length=100)
     */
    private $acte_libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="acte_date_enreg", type="datetime")
     */
    private $acte_date_enreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="acte_date_modif", type="datetime")
     */
    private $acte_date_modif;


    /**
     * @ORM\OneToMany(targetEntity="Soins", mappedBy="acte")
     * @var Soins[]
     */
    protected $soins;


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
     * Set acte_id
     *
     * @param integer $acte_id
     *
     * @return Acte
     */
    public function setActeId($acte_id)
    {
        $this->acte_id = $acte_id;

        return $this;
    }

    /**
     * Get acte_id
     *
     * @return int
     */
    public function getActeId()
    {
        return $this->acte_id;
    }

    /**
     * Set acte_code
     *
     * @param string $acte_code
     *
     * @return Acte
     */
    public function setActeCode($acte_code)
    {
        $this->acte_code = $acte_code;

        return $this;
    }

    /**
     * Get acte_code
     *
     * @return string
     */
    public function getActeCode()
    {
        return $this->acte_code;
    }

    /**
     * Set acte_libelle
     *
     * @param string $acte_libelle
     *
     * @return Acte
     */
    public function setActeLibelle($acte_libelle)
    {
        $this->acte_libelle = $acte_libelle;

        return $this;
    }

    /**
     * Get acte_libelle
     *
     * @return string
     */
    public function getActeLibelle()
    {
        return $this->acte_libelle;
    }

    /**
     * Set acte_date_enreg
     *
     * @param \DateTime $acte_date_enreg
     *
     * @return Acte
     */
    public function setActeDateEnreg($acte_date_enreg)
    {
        $this->acte_date_enreg = $acte_date_enreg;

        return $this;
    }

    /**
     * Get acte_date_enreg
     *
     * @return \DateTime
     */
    public function getActeDateEnreg()
    {
        return $this->acte_date_enreg;
    }

    /**
     * Set acte_date_modif
     *
     * @param \DateTime $acte_date_modif
     *
     * @return Acte
     */
    public function setActeDateModif($acte_date_modif)
    {
        $this->acte_date_modif = $acte_date_modif;

        return $this;
    }

    /**
     * Get acte_date_modif
     *
     * @return \DateTime
     */
    public function getActeDateModif()
    {
        return $this->acte_date_modif;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->soins = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add soin
     *
     * @param \Cmi\ApiBundle\Entity\Soins $soin
     *
     * @return Acte
     */
    public function addSoin(\Cmi\ApiBundle\Entity\Soins $soin)
    {
        $this->soins[] = $soin;

        return $this;
    }

    /**
     * Remove soin
     *
     * @param \Cmi\ApiBundle\Entity\Soins $soin
     */
    public function removeSoin(\Cmi\ApiBundle\Entity\Soins $soin)
    {
        $this->soins->removeElement($soin);
    }

    /**
     * Get soins
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSoins()
    {
        return $this->soins;
    }
}
