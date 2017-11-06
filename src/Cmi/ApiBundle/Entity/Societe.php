<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Societe
 *
 * @ORM\Table(name="societe")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\SocieteRepository")
 */
class Societe
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
     * @ORM\Column(name="socie_id", type="integer")
     */
    private $socie_id;

    /**
     * @var string
     *
     * @ORM\Column(name="socie_code", type="string")
     */
    private $socie_code;

    /**
     * @var string
     *
     * @ORM\Column(name="socie_libelle", type="string", length=100)
     */
    private $socie_libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="socie_date_enreg", type="datetime")
     */
    private $socie_date_enreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="socie_date_modif", type="datetime")
     */
    private $socie_date_modif;


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
     * Set socie_id
     *
     * @param integer $socie_id
     *
     * @return Societe
     */
    public function setSocieteId($socie_id)
    {
        $this->socie_id = $socie_id;

        return $this;
    }

    /**
     * Get socie_id
     *
     * @return int
     */
    public function getSocieteId()
    {
        return $this->socie_id;
    }

    /**
     * Set socie_code
     *
     * @param string $socie_code
     *
     * @return Societe
     */
    public function setSocieteCode($socie_code)
    {
        $this->socie_code = $socie_code;

        return $this;
    }

    /**
     * Get socie_code
     *
     * @return string
     */
    public function getSocieteCode()
    {
        return $this->socie_code;
    }

    /**
     * Set socie_libelle
     *
     * @param string $socie_libelle
     *
     * @return Societe
     */
    public function setSocieteLibelle($socie_libelle)
    {
        $this->socie_libelle = $socie_libelle;

        return $this;
    }

    /**
     * Get socie_libelle
     *
     * @return string
     */
    public function getSocieteLibelle()
    {
        return $this->socie_libelle;
    }

    /**
     * Set socie_date_enreg
     *
     * @param \DateTime $socie_date_enreg
     *
     * @return Societe
     */
    public function setSocieteDateEnreg($socie_date_enreg)
    {
        $this->socie_date_enreg = $socie_date_enreg;

        return $this;
    }

    /**
     * Get socie_date_enreg
     *
     * @return \DateTime
     */
    public function getSocieteDateEnreg()
    {
        return $this->socie_date_enreg;
    }

    /**
     * Set socie_date_modif
     *
     * @param \DateTime $socie_date_modif
     *
     * @return Societe
     */
    public function setSocieteDateModif($socie_date_modif)
    {
        $this->socie_date_modif = $socie_date_modif;

        return $this;
    }

    /**
     * Get socie_date_modif
     *
     * @return \DateTime
     */
    public function getSocieteDateModif()
    {
        return $this->socie_date_modif;
    }

    /**
     * Set socieId
     *
     * @param integer $socieId
     *
     * @return Societe
     */
    public function setSocieId($socieId)
    {
        $this->socie_id = $socieId;

        return $this;
    }

    /**
     * Get socieId
     *
     * @return integer
     */
    public function getSocieId()
    {
        return $this->socie_id;
    }

    /**
     * Set socieCode
     *
     * @param string $socieCode
     *
     * @return Societe
     */
    public function setSocieCode($socieCode)
    {
        $this->socie_code = $socieCode;

        return $this;
    }

    /**
     * Get socieCode
     *
     * @return string
     */
    public function getSocieCode()
    {
        return $this->socie_code;
    }

    /**
     * Set socieLibelle
     *
     * @param string $socieLibelle
     *
     * @return Societe
     */
    public function setSocieLibelle($socieLibelle)
    {
        $this->socie_libelle = $socieLibelle;

        return $this;
    }

    /**
     * Get socieLibelle
     *
     * @return string
     */
    public function getSocieLibelle()
    {
        return $this->socie_libelle;
    }

    /**
     * Set socieDateEnreg
     *
     * @param \DateTime $socieDateEnreg
     *
     * @return Societe
     */
    public function setSocieDateEnreg($socieDateEnreg)
    {
        $this->socie_date_enreg = $socieDateEnreg;

        return $this;
    }

    /**
     * Get socieDateEnreg
     *
     * @return \DateTime
     */
    public function getSocieDateEnreg()
    {
        return $this->socie_date_enreg;
    }

    /**
     * Set socieDateModif
     *
     * @param \DateTime $socieDateModif
     *
     * @return Societe
     */
    public function setSocieDateModif($socieDateModif)
    {
        $this->socie_date_modif = $socieDateModif;

        return $this;
    }

    /**
     * Get socieDateModif
     *
     * @return \DateTime
     */
    public function getSocieDateModif()
    {
        return $this->socie_date_modif;
    }
}
