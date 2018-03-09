<?php

namespace Cmi\ApiBundle\Entity;

use JMS\Serializer\Annotation as Serializer;
use Doctrine\ORM\Mapping as ORM;

/**
 * DroitAcces
 *
 * @ORM\Table(name="droit_acces",uniqueConstraints={@ORM\UniqueConstraint(name="users_droit_unique",columns={"user_id","daFonctionalite"})})
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\DroitAccesRepository")
 */
class DroitAcces
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @Serializer\Groups({"droitAcces","userconected"})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Serializer\Groups({"droitAcces","userconected"})
     * @ORM\Column(name="daFonctionalite", type="string", length=255)
     */
    private $daFonctionalite;

    /**
     * @var \DateTime
     *
     * @Serializer\Groups({"droitAcces","userconected"})
     * @ORM\Column(name="daDateEnreg", type="datetime")
     */
    private $daDateEnreg;

    /**
     * @var \DateTime
     *
     * @Serializer\Groups({"droitAcces","userconected"})
     * @ORM\Column(name="daDateModif", type="datetime")
     */
    private $daDateModif;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="droitAccess")
     * @var User
     * @Serializer\Groups({"droitAcces"})
     */
    private $user;

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
     * Set daFonctionalite
     *
     * @param string $daFonctionalite
     *
     * @return DroitAcces
     */
    public function setDaFonctionalite($daFonctionalite)
    {
        $this->daFonctionalite = $daFonctionalite;

        return $this;
    }

    /**
     * Get daFonctionalite
     *
     * @return string
     */
    public function getDaFonctionalite()
    {
        return $this->daFonctionalite;
    }

    /**
     * Set daDateEnreg
     *
     * @param \DateTime $daDateEnreg
     *
     * @return DroitAcces
     */
    public function setDaDateEnreg($daDateEnreg)
    {
        $this->daDateEnreg = $daDateEnreg;

        return $this;
    }

    /**
     * Get daDateEnreg
     *
     * @return \DateTime
     */
    public function getDaDateEnreg()
    {
        return $this->daDateEnreg;
    }

    /**
     * Set daDateModif
     *
     * @param \DateTime $daDateModif
     *
     * @return DroitAcces
     */
    public function setDaDateModif($daDateModif)
    {
        $this->daDateModif = $daDateModif;

        return $this;
    }

    /**
     * Get daDateModif
     *
     * @return \DateTime
     */
    public function getDaDateModif()
    {
        return $this->daDateModif;
    }


    /**
     * Set user
     *
     * @param \Cmi\ApiBundle\Entity\User $user
     *
     * @return DroitAcces
     */
    public function setUser(\Cmi\ApiBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Cmi\ApiBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
