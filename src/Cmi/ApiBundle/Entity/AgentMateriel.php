<?php

namespace Cmi\ApiBundle\Entity;

/**
 * AgentMateriel
 */
class AgentMateriel
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $amCode;

    /**
     * @var string
     */
    private $amLibelle;

    /**
     * @var \DateTime
     */
    private $amDateEnreg;

    /**
     * @var \DateTime
     */
    private $amDateModif;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set amCode
     *
     * @param string $amCode
     *
     * @return AgentMateriel
     */
    public function setAmCode($amCode)
    {
        $this->amCode = $amCode;

        return $this;
    }

    /**
     * Get amCode
     *
     * @return string
     */
    public function getAmCode()
    {
        return $this->amCode;
    }

    /**
     * Set amLibelle
     *
     * @param string $amLibelle
     *
     * @return AgentMateriel
     */
    public function setAmLibelle($amLibelle)
    {
        $this->amLibelle = $amLibelle;

        return $this;
    }

    /**
     * Get amLibelle
     *
     * @return string
     */
    public function getAmLibelle()
    {
        return $this->amLibelle;
    }

    /**
     * Set amDateEnreg
     *
     * @param \DateTime $amDateEnreg
     *
     * @return AgentMateriel
     */
    public function setAmDateEnreg($amDateEnreg)
    {
        $this->amDateEnreg = $amDateEnreg;

        return $this;
    }

    /**
     * Get amDateEnreg
     *
     * @return \DateTime
     */
    public function getAmDateEnreg()
    {
        return $this->amDateEnreg;
    }

    /**
     * Set amDateModif
     *
     * @param \DateTime $amDateModif
     *
     * @return AgentMateriel
     */
    public function setAmDateModif($amDateModif)
    {
        $this->amDateModif = $amDateModif;

        return $this;
    }

    /**
     * Get amDateModif
     *
     * @return \DateTime
     */
    public function getAmDateModif()
    {
        return $this->amDateModif;
    }
}

