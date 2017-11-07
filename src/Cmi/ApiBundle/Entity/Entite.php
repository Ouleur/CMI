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
     * @ORM\OneToMany(targetEntity="Entite", mappedBy="parent")
     * @var Entite[]
     */
    private $enfants;


    /**
     * @ORM\ManyToOne(targetEntity="Entite", inversedBy="endants")
     * @var Entite
     */
    protected $parent;

    /**
     * @ORM\ManyToOne(targetEntity="Societe", inversedBy="entite")
     * @var Societe
     */
    protected $societe;

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
    

    /**
     * Set societe
     *
     * @param \Cmi\ApiBundle\Entity\Societe $societe
     *
     * @return Entite
     */
    public function setSociete(\Cmi\ApiBundle\Entity\Societe $societe = null)
    {
        $this->societe = $societe;

        return $this;
    }

    /**
     * Get societe
     *
     * @return \Cmi\ApiBundle\Entity\Societe
     */
    public function getSociete()
    {
        return $this->societe;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->enfants = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add enfant
     *
     * @param \Cmi\ApiBundle\Entity\Entite $enfant
     *
     * @return Entite
     */
    public function addEnfant(\Cmi\ApiBundle\Entity\Entite $enfant)
    {
        $this->enfants[] = $enfant;

        return $this;
    }

    /**
     * Remove enfant
     *
     * @param \Cmi\ApiBundle\Entity\Entite $enfant
     */
    public function removeEnfant(\Cmi\ApiBundle\Entity\Entite $enfant)
    {
        $this->enfants->removeElement($enfant);
    }

    /**
     * Get enfants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnfants()
    {
        return $this->enfants;
    }

    /**
     * Set parent
     *
     * @param \Cmi\ApiBundle\Entity\Entite $parent
     *
     * @return Entite
     */
    public function setParent(\Cmi\ApiBundle\Entity\Entite $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Cmi\ApiBundle\Entity\Entite
     */
    public function getParent()
    {
        return $this->parent;
    }
}
