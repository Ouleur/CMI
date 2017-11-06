<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agent
 *
 * @ORM\Table(name="agent")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\AgentRepository")
 */
class Agent
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
     * @ORM\Column(name="agent_entite_id", type="integer")
     */
    private $agentEntiteId;

    /**
     * @var array
     *
     * @ORM\Column(name="agent_ay_dt_ids", type="array")
     */
    private $agentAyDtIds;

    /**
     * @var int
     *
     * @ORM\Column(name="agent_l_trav_id", type="integer")
     */
    private $agentLTravId;

    /**
     * @var int
     *
     * @ORM\Column(name="agent_carte_id", type="integer")
     */
    private $agentCarteId;

    /**
     * @var int
     *
     * @ORM\Column(name="agent_t_contrat_id", type="integer")
     */
    private $agentTContratId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="agent_date_enreg", type="datetime")
     */
    private $agentDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="agent_date_modif", type="datetime")
     */
    private $agentDateModif;


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
     * Set agentEntiteId
     *
     * @param integer $agentEntiteId
     *
     * @return Agent
     */
    public function setAgentEntiteId($agentEntiteId)
    {
        $this->agentEntiteId = $agentEntiteId;

        return $this;
    }

    /**
     * Get agentEntiteId
     *
     * @return int
     */
    public function getAgentEntiteId()
    {
        return $this->agentEntiteId;
    }

    /**
     * Set agentAyDtIds
     *
     * @param array $agentAyDtIds
     *
     * @return Agent
     */
    public function setAgentAyDtIds($agentAyDtIds)
    {
        $this->agentAyDtIds = $agentAyDtIds;

        return $this;
    }

    /**
     * Get agentAyDtIds
     *
     * @return array
     */
    public function getAgentAyDtIds()
    {
        return $this->agentAyDtIds;
    }

    /**
     * Set agentLTravId
     *
     * @param integer $agentLTravId
     *
     * @return Agent
     */
    public function setAgentLTravId($agentLTravId)
    {
        $this->agentLTravId = $agentLTravId;

        return $this;
    }

    /**
     * Get agentLTravId
     *
     * @return int
     */
    public function getAgentLTravId()
    {
        return $this->agentLTravId;
    }

    /**
     * Set agentCarteId
     *
     * @param integer $agentCarteId
     *
     * @return Agent
     */
    public function setAgentCarteId($agentCarteId)
    {
        $this->agentCarteId = $agentCarteId;

        return $this;
    }

    /**
     * Get agentCarteId
     *
     * @return int
     */
    public function getAgentCarteId()
    {
        return $this->agentCarteId;
    }

    /**
     * Set agentTContratId
     *
     * @param integer $agentTContratId
     *
     * @return Agent
     */
    public function setAgentTContratId($agentTContratId)
    {
        $this->agentTContratId = $agentTContratId;

        return $this;
    }

    /**
     * Get agentTContratId
     *
     * @return int
     */
    public function getAgentTContratId()
    {
        return $this->agentTContratId;
    }

    /**
     * Set agentDateEnreg
     *
     * @param \DateTime $agentDateEnreg
     *
     * @return Agent
     */
    public function setAgentDateEnreg($agentDateEnreg)
    {
        $this->agentDateEnreg = $agentDateEnreg;

        return $this;
    }

    /**
     * Get agentDateEnreg
     *
     * @return \DateTime
     */
    public function getAgentDateEnreg()
    {
        return $this->agentDateEnreg;
    }

    /**
     * Set agentDateModif
     *
     * @param \DateTime $agentDateModif
     *
     * @return Agent
     */
    public function setAgentDateModif($agentDateModif)
    {
        $this->agentDateModif = $agentDateModif;

        return $this;
    }

    /**
     * Get agentDateModif
     *
     * @return \DateTime
     */
    public function getAgentDateModif()
    {
        return $this->agentDateModif;
    }
}
