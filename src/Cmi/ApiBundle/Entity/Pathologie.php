<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pathologie
 *
 * @ORM\Table(name="pathologie")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\PathologieRepository")
 */
class Pathologie
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
     * @ORM\Column(name="patho_id", type="integer")
     */
    private $patho_id;

    /**
     * @var string
     *
     * @ORM\Column(name="patho_code", type="string")
     */
    private $patho_code;

    /**
     * @var string
     *
     * @ORM\Column(name="patho_libelle", type="string")
     */
    private $patho_libelle;

    /**
     * @var int
     *
     * @ORM\Column(name="patho_famille_id", type="integer")
     */
    private $patho_famille_id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="patho_date_enreg", type="datetime")
     */
    private $patho_date_enreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="patho_date_modif", type="datetime")
     */
    private $patho_date_modif;


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
     * Set patho_id
     *
     * @param integer $patho_id
     *
     * @return Pathologie
     */
    public function setPathoId($patho_id)
    {
        $this->patho_id = $patho_id;

        return $this;
    }

    /**
     * Get patho_id
     *
     * @return int
     */
    public function getPathoId()
    {
        return $this->patho_id;
    }

    /**
     * Set patho_code
     *
     * @param string $patho_code
     *
     * @return Pathologie
     */
    public function setPathoCode($patho_code)
    {
        $this->patho_code = $patho_code;

        return $this;
    }

    /**
     * Get patho_code
     *
     * @return string
     */
    public function getPathoCode()
    {
        return $this->patho_code;
    }

    /**
     * Set patho_libelle
     *
     * @param string $patho_libelle
     *
     * @return Pathologie
     */
    public function setPathoLibelle($patho_libelle)
    {
        $this->patho_libelle = $patho_libelle;

        return $this;
    }

    /**
     * Get patho_libelle
     *
     * @return string
     */
    public function getPathoLibelle()
    {
        return $this->patho_libelle;
    }

    /**
     * Set patho_famille_id
     *
     * @param integer $patho_famille_id
     *
     * @return Pathologie
     */
    public function setPathoFamilleId($patho_famille_id)
    {
        $this->patho_famille_id = $patho_famille_id;

        return $this;
    }

    /**
     * Get patho_famille_id
     *
     * @return int
     */
    public function getPathoFamilleId()
    {
        return $this->patho_famille_id;
    }

    /**
     * Set patho_date_enreg
     *
     * @param \DateTime $patho_date_enreg
     *
     * @return Pathologie
     */
    public function setPathoDateEnreg($patho_date_enreg)
    {
        $this->patho_date_enreg = $patho_date_enreg;

        return $this;
    }

    /**
     * Get patho_date_enreg
     *
     * @return \DateTime
     */
    public function getPathoDateEnreg()
    {
        return $this->patho_date_enreg;
    }

    /**
     * Set patho_date_modif
     *
     * @param \DateTime $patho_date_modif
     *
     * @return Pathologie
     */
    public function setPathoDateModif($patho_date_modif)
    {
        $this->patho_date_modif = $patho_date_modif;

        return $this;
    }

    /**
     * Get patho_date_modif
     *
     * @return \DateTime
     */
    public function getPathoDateModif()
    {
        return $this->patho_date_modif;
    }
}
