<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * AgentMateriel
 *
 * @ORM\Table(name="agent_materiel")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\AgentMaterielRepository")
 */
class AgentMateriel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"agent_materiel","accident"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="am_code", type="string", length=100)
     * @Serializer\Groups({"agent_materiel","accident"})
     */
    private $amCode;

    /**
     * @var string
     *
     * @ORM\Column(name="am_libelle", type="string", length=255, unique=true)
     * @Serializer\Groups({"agent_materiel","accident"})
     */
    private $amLibelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="am_date_enreg", type="datetime")
     * @Serializer\Groups({"agent_materiel"})
     */
    private $amDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="am_date_modif", type="datetime")
     * @Serializer\Groups({"agent_materiel"})
     */
    private $amDateModif;

    /**
     * @ORM\OneToMany(targetEntity="AccidentTravail", mappedBy="agentMateriel")
     * @var Accident[]
     * @Serializer\Groups({"agent_materiel"})
     */
    private $accidents;

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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->accidents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add accident
     *
     * @param \Cmi\ApiBundle\Entity\AccidentTravail $accident
     *
     * @return AgentMateriel
     */
    public function addAccident(\Cmi\ApiBundle\Entity\AccidentTravail $accident)
    {
        $this->accidents[] = $accident;

        return $this;
    }

    /**
     * Remove accident
     *
     * @param \Cmi\ApiBundle\Entity\AccidentTravail $accident
     */
    public function removeAccident(\Cmi\ApiBundle\Entity\AccidentTravail $accident)
    {
        $this->accidents->removeElement($accident);
    }

    /**
     * Get accidents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccidents()
    {
        return $this->accidents;
    }
}
