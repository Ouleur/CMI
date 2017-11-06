<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etape
 *
 * @ORM\Table(name="etape")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\EtapeRepository")
 */
class Etape
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
     * @ORM\Column(name="etp_id", type="integer")
     */
    private $etp_id;

    /**
     * @var string
     *
     * @ORM\Column(name="etp_code", type="string")
     */
    private $etp_code;

    /**
     * @var string
     *
     * @ORM\Column(name="etp_libelle", type="string", length=100)
     */
    private $etp_libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="etp_date_enreg", type="datetime")
     */
    private $etp_date_enreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="etp_date_modif", type="datetime")
     */
    private $etp_date_modif;


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
     * Set etp_id
     *
     * @param integer $etp_id
     *
     * @return Etape
     */
    public function setEtpId($etp_id)
    {
        $this->etp_id = $etp_id;

        return $this;
    }

    /**
     * Get etp_id
     *
     * @return int
     */
    public function getEtpId()
    {
        return $this->etp_id;
    }

    /**
     * Set etp_code
     *
     * @param string $etp_code
     *
     * @return Etape
     */
    public function setEtpCode($etp_code)
    {
        $this->etp_code = $etp_code;

        return $this;
    }

    /**
     * Get etp_code
     *
     * @return string
     */
    public function getEtpCode()
    {
        return $this->etp_code;
    }

    /**
     * Set etp_libelle
     *
     * @param string $etp_libelle
     *
     * @return Etape
     */
    public function setEtpLibelle($etp_libelle)
    {
        $this->etp_libelle = $etp_libelle;

        return $this;
    }

    /**
     * Get etp_libelle
     *
     * @return string
     */
    public function getEtpLibelle()
    {
        return $this->etp_libelle;
    }

    /**
     * Set etp_date_enreg
     *
     * @param \DateTime $etp_date_enreg
     *
     * @return Etape
     */
    public function setEtpDateEnreg($etp_date_enreg)
    {
        $this->etp_date_enreg = $etp_date_enreg;

        return $this;
    }

    /**
     * Get etp_date_enreg
     *
     * @return \DateTime
     */
    public function getEtpDateEnreg()
    {
        return $this->etp_date_enreg;
    }

    /**
     * Set etp_date_modif
     *
     * @param \DateTime $etp_date_modif
     *
     * @return Etape
     */
    public function setEtpDateModif($etp_date_modif)
    {
        $this->etp_date_modif = $etp_date_modif;

        return $this;
    }

    /**
     * Get etp_date_modif
     *
     * @return \DateTime
     */
    public function getEtpDateModif()
    {
        return $this->etp_date_modif;
    }
}
