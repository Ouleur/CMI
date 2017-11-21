<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Motif
 *
 * @ORM\Table(name="motif")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\MotifRepository")
 */
class Motif
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
     * @ORM\Column(name="motif_code", type="string")
     */
    private $motif_code;

    /**
     * @var string
     *
     * @ORM\Column(name="motif_libelle", type="string", length=100)
     */
    private $motif_libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="motif_date_enreg", type="datetime")
     */
    private $motif_date_enreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="motif_date_modif", type="datetime")
     */
    private $motif_date_modif;


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
     * Set motif_code
     *
     * @param string $motif_code
     *
     * @return Motif
     */
    public function setMotifCode($motif_code)
    {
        $this->motif_code = $motif_code;

        return $this;
    }

    /**
     * Get motif_code
     *
     * @return string
     */
    public function getMotifCode()
    {
        return $this->motif_code;
    }

    /**
     * Set motif_libelle
     *
     * @param string $motif_libelle
     *
     * @return Motif
     */
    public function setMotifLibelle($motif_libelle)
    {
        $this->motif_libelle = $motif_libelle;

        return $this;
    }

    /**
     * Get motif_libelle
     *
     * @return string
     */
    public function getMotifLibelle()
    {
        return $this->motif_libelle;
    }

    /**
     * Set motif_date_enreg
     *
     * @param \DateTime $motif_date_enreg
     *
     * @return Motif
     */
    public function setMotifDateEnreg($motif_date_enreg)
    {
        $this->motif_date_enreg = $motif_date_enreg;

        return $this;
    }

    /**
     * Get motif_date_enreg
     *
     * @return \DateTime
     */
    public function getMotifDateEnreg()
    {
        return $this->motif_date_enreg;
    }

    /**
     * Set motif_date_modif
     *
     * @param \DateTime $motif_date_modif
     *
     * @return Motif
     */
    public function setMotifDateModif($motif_date_modif)
    {
        $this->motif_date_modif = $motif_date_modif;

        return $this;
    }

    /**
     * Get motif_date_modif
     *
     * @return \DateTime
     */
    public function getMotifDateModif()
    {
        return $this->motif_date_modif;
    }
}
