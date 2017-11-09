<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NatureAccident
 *
 * @ORM\Table(name="nature_accident")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\NatureAccidentRepository")
 */
class NatureAccident
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
     * @ORM\Column(name="na_code", type="string", length=10, nullable=true)
     */
    private $naCode;

    /**
     * @var string
     *
     * @ORM\Column(name="na_libelle", type="string", length=150, nullable=true)
     */
    private $naLibelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="na_date_enreg", type="datetime")
     */
    private $naDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="na_date_modif", type="datetime")
     */
    private $naDateModif;


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
     * Set naCode
     *
     * @param string $naCode
     *
     * @return NatureAccident
     */
    public function setNaCode($naCode)
    {
        $this->naCode = $naCode;

        return $this;
    }

    /**
     * Get naCode
     *
     * @return string
     */
    public function getNaCode()
    {
        return $this->naCode;
    }

    /**
     * Set naLibelle
     *
     * @param string $naLibelle
     *
     * @return NatureAccident
     */
    public function setNaLibelle($naLibelle)
    {
        $this->naLibelle = $naLibelle;

        return $this;
    }

    /**
     * Get naLibelle
     *
     * @return string
     */
    public function getNaLibelle()
    {
        return $this->naLibelle;
    }

    /**
     * Set naDateEnreg
     *
     * @param string $naDateEnreg
     *
     * @return NatureAccident
     */
    public function setNaDateEnreg($naDateEnreg)
    {
        $this->naDateEnreg = $naDateEnreg;

        return $this;
    }

    /**
     * Get naDateEnreg
     *
     * @return string
     */
    public function getNaDateEnreg()
    {
        return $this->naDateEnreg;
    }

    /**
     * Set naDateModif
     *
     * @param \DateTime $naDateModif
     *
     * @return NatureAccident
     */
    public function setNaDateModif($naDateModif)
    {
        $this->naDateModif = $naDateModif;

        return $this;
    }

    /**
     * Get naDateModif
     *
     * @return \DateTime
     */
    public function getNaDateModif()
    {
        return $this->naDateModif;
    }
}
