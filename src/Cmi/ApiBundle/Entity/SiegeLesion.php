<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SiegeLesion
 *
 * @ORM\Table(name="siege_lesion")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\SiegeLesionRepository")
 */
class SiegeLesion
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
     * @ORM\Column(name="sl_code", type="string", length=10, nullable=true)
     */
    private $slCode;

    /**
     * @var string
     *
     * @ORM\Column(name="sl_libelle", type="string", length=150)
     */
    private $slLibelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sl_date_enreg", type="datetime")
     */
    private $slDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sl_date_modif", type="datetime")
     */
    private $slDateModif;


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
     * Set slCode
     *
     * @param string $slCode
     *
     * @return SiegeLesion
     */
    public function setSlCode($slCode)
    {
        $this->slCode = $slCode;

        return $this;
    }

    /**
     * Get slCode
     *
     * @return string
     */
    public function getSlCode()
    {
        return $this->slCode;
    }

    /**
     * Set slLibelle
     *
     * @param string $slLibelle
     *
     * @return SiegeLesion
     */
    public function setSlLibelle($slLibelle)
    {
        $this->slLibelle = $slLibelle;

        return $this;
    }

    /**
     * Get slLibelle
     *
     * @return string
     */
    public function getSlLibelle()
    {
        return $this->slLibelle;
    }

    /**
     * Set slDateEnreg
     *
     * @param \DateTime $slDateEnreg
     *
     * @return SiegeLesion
     */
    public function setSlDateEnreg($slDateEnreg)
    {
        $this->slDateEnreg = $slDateEnreg;

        return $this;
    }

    /**
     * Get slDateEnreg
     *
     * @return \DateTime
     */
    public function getSlDateEnreg()
    {
        return $this->slDateEnreg;
    }

    /**
     * Set slDateModif
     *
     * @param \DateTime $slDateModif
     *
     * @return SiegeLesion
     */
    public function setSlDateModif($slDateModif)
    {
        $this->slDateModif = $slDateModif;

        return $this;
    }

    /**
     * Get slDateModif
     *
     * @return \DateTime
     */
    public function getSlDateModif()
    {
        return $this->slDateModif;
    }
}
