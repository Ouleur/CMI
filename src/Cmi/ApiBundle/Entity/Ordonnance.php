<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ordonnance
 *
 * @ORM\Table(name="ordonnance")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\OrdonnanceRepository")
 */
class Ordonnance
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
     * @ORM\Column(name="ordo_id", type="integer")
     */
    private $ordo_id;

    /**
    * @var int
    *
    * @ORM\Column(name="ordo_consul_id", type="integer")
    */
    private $ordo_consul_id;

    /**
    * @var int
    *
    * @ORM\Column(name="ordo_medic_id", type="integer")
    */
    private $ordo_medic_id;

    /**
     * @var string
     *
     * @ORM\Column(name="ordo_posologie", type="string")
     */
    private $ordo_posologie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ordo_date_enreg", type="datetime")
     */
    private $ordo_date_enreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ordo_date_modif", type="datetime")
     */
    private $ordo_date_modif;


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
     * Set ordo_id
     *
     * @param integer $ordo_id
     *
     * @return Ordonnance
     */
    public function setOrdoId($ordo_id)
    {
        $this->ordo_id = $ordo_id;

        return $this;
    }

    /**
     * Get ordo_id
     *
     * @return int
     */
    public function getOrdoId()
    {
        return $this->ordo_id;
    }

    /**
     * Set ordo_consul_id
     *
     * @param integer $ordo_consul_id
     *
     * @return Ordonnance
     */
    public function setOrdoConsulId($ordo_consul_id)
    {
        $this->ordo_consul_id = $ordo_consul_id;

        return $this;
    }

    /**
     * Get ordo_consul_id
     *
     * @return int
     */
    public function getOrdoConsulId()
    {
        return $this->ordo_consul_id;
    }

    /**
     * Set ordo_medic_id
     *
     * @param integer $ordo_medic_id
     *
     * @return Ordonnance
     */
    public function setOrdoMedicId($ordo_medic_id)
    {
        $this->ordo_medic_id = $ordo_medic_id;

        return $this;
    }

    /**
     * Get ordo_medic_id
     *
     * @return int
     */
    public function getOrdoMedicId()
    {
        return $this->ordo_medic_id;
    }

    /**
     * Set ordo_posologie
     *
     * @param string $ordo_posologie
     *
     * @return Ordonnance
     */
    public function setOrdoPosologie($ordo_posologie)
    {
        $this->ordo_posologie = $ordo_posologie;

        return $this;
    }

    /**
     * Get ordo_posologie
     *
     * @return string
     */
    public function getOrdoPosologie()
    {
        return $this->ordo_posologie;
    }

    /**
     * Set ordo_date_enreg
     *
     * @param \DateTime $ordo_date_enreg
     *
     * @return Ordonnance
     */
    public function setOrdoDateEnreg($ordo_date_enreg)
    {
        $this->ordo_date_enreg = $ordo_date_enreg;

        return $this;
    }

    /**
     * Get ordo_date_enreg
     *
     * @return \DateTime
     */
    public function getOrdoDateEnreg()
    {
        return $this->ordo_date_enreg;
    }

    /**
     * Set ordo_date_modif
     *
     * @param \DateTime $ordo_date_modif
     *
     * @return Ordonnance
     */
    public function setOrdoDateModif($ordo_date_modif)
    {
        $this->ordo_date_modif = $ordo_date_modif;

        return $this;
    }

    /**
     * Get ordo_date_modif
     *
     * @return \DateTime
     */
    public function getOrdoDateModif()
    {
        return $this->ordo_date_modif;
    }
}
