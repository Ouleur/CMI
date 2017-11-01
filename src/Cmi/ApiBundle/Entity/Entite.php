<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entite
 *
 * @ORM\Table(name="entite")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\EntiteRepository")
 */
class Entite
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
     * @ORM\Column(name="enti_id", type="integer")
     */
    private $entiId;

    /**
     * @var string
     *
     * @ORM\Column(name="enti_code", type="string", length=10)
     */
    private $entiCode;

    /**
     * @var string
     *
     * @ORM\Column(name="enti_libelle", type="string", length=100)
     */
    private $entiLibelle;

    /**
     * @var int
     *
     * @ORM\Column(name="enti_societe_id", type="integer")
     */
    private $entiSocieteId;

    /**
     * @var int
     *
     * @ORM\Column(name="enti_parent_id", type="integer")
     */
    private $entiParentId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="enti_date_enreg", type="datetime")
     */
    private $entiDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="enti_date_modif", type="datetime")
     */
    private $entiDateModif;


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
     * Set entiCode
     *
     * @param string $entiCode
     *
     * @return Entite
     */
    public function setEntiCode($entiCode)
    {
        $this->entiCode = $entiCode;

        return $this;
    }

    /**
     * Get entiCode
     *
     * @return string
     */
    public function getEntiCode()
    {
        return $this->entiCode;
    }

    /**
     * Set entiLibelle
     *
     * @param string $entiLibelle
     *
     * @return Entite
     */
    public function setEntiLibelle($entiLibelle)
    {
        $this->entiLibelle = $entiLibelle;

        return $this;
    }

    /**
     * Get entiLibelle
     *
     * @return string
     */
    public function getEntiLibelle()
    {
        return $this->entiLibelle;
    }

    /**
     * Set entiSocieteId
     *
     * @param integer $entiSocieteId
     *
     * @return Entite
     */
    public function setEntiSocieteId($entiSocieteId)
    {
        $this->entiSocieteId = $entiSocieteId;

        return $this;
    }

    /**
     * Get entiSocieteId
     *
     * @return int
     */
    public function getEntiSocieteId()
    {
        return $this->entiSocieteId;
    }

    /**
     * Set entiParentId
     *
     * @param integer $entiParentId
     *
     * @return Entite
     */
    public function setEntiParentId($entiParentId)
    {
        $this->entiParentId = $entiParentId;

        return $this;
    }

    /**
     * Get entiParentId
     *
     * @return int
     */
    public function getEntiParentId()
    {
        return $this->entiParentId;
    }

    /**
     * Set entiDateEnreg
     *
     * @param \DateTime $entiDateEnreg
     *
     * @return Entite
     */
    public function setEntiDateEnreg($entiDateEnreg)
    {
        $this->entiDateEnreg = $entiDateEnreg;

        return $this;
    }

    /**
     * Get entiDateEnreg
     *
     * @return \DateTime
     */
    public function getEntiDateEnreg()
    {
        return $this->entiDateEnreg;
    }

    /**
     * Set entiDateModif
     *
     * @param \DateTime $entiDateModif
     *
     * @return Entite
     */
    public function setEntiDateModif($entiDateModif)
    {
        $this->entiDateModif = $entiDateModif;

        return $this;
    }

    /**
     * Get entiDateModif
     *
     * @return \DateTime
     */
    public function getEntiDateModif()
    {
        return $this->entiDateModif;
    }
}

