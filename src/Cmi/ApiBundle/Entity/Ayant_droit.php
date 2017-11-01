<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ayant_droit
 *
 * @ORM\Table(name="ayant_droit")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\Ayant_droitRepository")
 */
class Ayant_droit
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
     * @ORM\Column(name="ay_droit_agent_id", type="integer")
     */
    private $ayDroitAgentId;

    /**
     * @var string
     *
     * @ORM\Column(name="ay_droit_qualite", type="string", length=255)
     */
    private $ayDroitQualite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ay_droit_date_enreg", type="datetime")
     */
    private $ayDroitDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ay_droit_date_modif", type="datetime")
     */
    private $ayDroitDateModif;


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
     * Set ayDroitAgentId
     *
     * @param integer $ayDroitAgentId
     *
     * @return Ayant_droit
     */
    public function setAyDroitAgentId($ayDroitAgentId)
    {
        $this->ayDroitAgentId = $ayDroitAgentId;

        return $this;
    }

    /**
     * Get ayDroitAgentId
     *
     * @return int
     */
    public function getAyDroitAgentId()
    {
        return $this->ayDroitAgentId;
    }

    /**
     * Set ayDroitQualite
     *
     * @param string $ayDroitQualite
     *
     * @return Ayant_droit
     */
    public function setAyDroitQualite($ayDroitQualite)
    {
        $this->ayDroitQualite = $ayDroitQualite;

        return $this;
    }

    /**
     * Get ayDroitQualite
     *
     * @return string
     */
    public function getAyDroitQualite()
    {
        return $this->ayDroitQualite;
    }

    /**
     * Set ayDroitDateEnreg
     *
     * @param \DateTime $ayDroitDateEnreg
     *
     * @return Ayant_droit
     */
    public function setAyDroitDateEnreg($ayDroitDateEnreg)
    {
        $this->ayDroitDateEnreg = $ayDroitDateEnreg;

        return $this;
    }

    /**
     * Get ayDroitDateEnreg
     *
     * @return \DateTime
     */
    public function getAyDroitDateEnreg()
    {
        return $this->ayDroitDateEnreg;
    }

    /**
     * Set ayDroitDateModif
     *
     * @param \DateTime $ayDroitDateModif
     *
     * @return Ayant_droit
     */
    public function setAyDroitDateModif($ayDroitDateModif)
    {
        $this->ayDroitDateModif = $ayDroitDateModif;

        return $this;
    }

    /**
     * Get ayDroitDateModif
     *
     * @return \DateTime
     */
    public function getAyDroitDateModif()
    {
        return $this->ayDroitDateModif;
    }
}

