<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NatureLesion
 *
 * @ORM\Table(name="nature_lesion")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\NatureLesionRepository")
 */
class NatureLesion
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
     * @ORM\Column(name="nl_code", type="string", length=10, nullable=true)
     */
    private $nlCode;

    /**
     * @var string
     *
     * @ORM\Column(name="nl_libelle", type="string", length=150, nullable=true)
     */
    private $nlLibelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="nl_date_enreg", type="datetime")
     */
    private $nlDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="nl_date_modif", type="datetime")
     */
    private $nlDateModif;


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
     * Set nlCode
     *
     * @param string $nlCode
     *
     * @return NatureLesion
     */
    public function setNlCode($nlCode)
    {
        $this->nlCode = $nlCode;

        return $this;
    }

    /**
     * Get nlCode
     *
     * @return string
     */
    public function getNlCode()
    {
        return $this->nlCode;
    }

    /**
     * Set nlLibelle
     *
     * @param string $nlLibelle
     *
     * @return NatureLesion
     */
    public function setNlLibelle($nlLibelle)
    {
        $this->nlLibelle = $nlLibelle;

        return $this;
    }

    /**
     * Get nlLibelle
     *
     * @return string
     */
    public function getNlLibelle()
    {
        return $this->nlLibelle;
    }

    /**
     * Set nlDateEnreg
     *
     * @param \DateTime $nlDateEnreg
     *
     * @return NatureLesion
     */
    public function setNlDateEnreg($nlDateEnreg)
    {
        $this->nlDateEnreg = $nlDateEnreg;

        return $this;
    }

    /**
     * Get nlDateEnreg
     *
     * @return \DateTime
     */
    public function getNlDateEnreg()
    {
        return $this->nlDateEnreg;
    }

    /**
     * Set nlDateModif
     *
     * @param \DateTime $nlDateModif
     *
     * @return NatureLesion
     */
    public function setNlDateModif($nlDateModif)
    {
        $this->nlDateModif = $nlDateModif;

        return $this;
    }

    /**
     * Get nlDateModif
     *
     * @return \DateTime
     */
    public function getNlDateModif()
    {
        return $this->nlDateModif;
    }
}
