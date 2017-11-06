<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Autre
 *
 * @ORM\Table(name="autre")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\AutreRepository")
 */
class Autre
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /*
     * @var int
     *
     * @ORM\Column(name="autre_proff_id", type="integer")
     */
    private $autreProffId;

    /**
     * @var string
     *
     * @ORM\Column(name="autre_entreprise", type="string", length=100, nullable=true)
     */
    private $autreEntreprise;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="autre_date_enreg", type="datetime")
     */
    private $autreDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="autre_date_modif", type="datetime")
     */
    private $autreDateModif;


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
     * Set autreId
     *
     * @param integer $autreId
     *
     * @return Autre
     */
    public function setAutreId($autreId)
    {
        $this->autreId = $autreId;

        return $this;
    }

    
    /**
     * Get autreProffId
     *
     * @return int
     */
    public function getAutreProffId()
    {
        return $this->autreProffId;
    }

    /**
     * Set autreProffId
     *
     * @param string $autreProffId
     *
     * @return Autre
     */
    public function setAutreProffId($autreProffId)
    {
        $this->autreProffId = $autreProffId;

        return $this;
    }

    /**
     * Set autreEntreprise
     *
     * @param string $autreEntreprise
     *
     * @return Autre
     */
    public function setAutreEntreprise($autreEntreprise)
    {
        $this->autreEntreprise = $autreEntreprise;

        return $this;
    }

    /**
     * Get autreEntreprise
     *
     * @return string
     */
    public function getAutreEntreprise()
    {
        return $this->autreEntreprise;
    }

    /**
     * Set autreDateEnreg
     *
     * @param \DateTime $autreDateEnreg
     *
     * @return Autre
     */
    public function setAutreDateEnreg($autreDateEnreg)
    {
        $this->autreDateEnreg = $autreDateEnreg;

        return $this;
    }

    /**
     * Get autreDateEnreg
     *
     * @return \DateTime
     */
    public function getAutreDateEnreg()
    {
        return $this->autreDateEnreg;
    }

    /**
     * Set autreDateModif
     *
     * @param \DateTime $autreDateModif
     *
     * @return Autre
     */
    public function setAutreDateModif($autreDateModif)
    {
        $this->autreDateModif = $autreDateModif;

        return $this;
    }

    /**
     * Get autreDateModif
     *
     * @return \DateTime
     */
    public function getAutreDateModif()
    {
        return $this->autreDateModif;
    }
}
