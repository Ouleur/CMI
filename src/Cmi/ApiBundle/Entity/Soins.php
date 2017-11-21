<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


/**
 * Soins
 *
 * @ORM\Table(name="soins")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\SoinsRepository")
 */
class Soins
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"consultation","soins"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="soins_commentaire", type="string", length=100)
     * @Serializer\Groups({"consultation","soins"})
     */
    private $soins_commentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="soins_date_enreg", type="datetime")
     * @Serializer\Groups({"soins"})
     */
    private $soins_date_enreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="soins_date_modif", type="datetime")
     * @Serializer\Groups({"soins"})
     */
    private $soins_date_modif;

    /**
     * @ORM\ManyToOne(targetEntity="Consultation", inversedBy="soins")
     * @var Consultation
     * @Serializer\Groups({"soins","acte"})
     */
    private $consultation;

    /**
     * @ORM\ManyToOne(targetEntity="Acte", inversedBy="soins")
     * @var Acte
     * @Serializer\Groups({"consultation","soins"})
     */
    private $acte;

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
     * Set soins_commentaire
     *
     * @param string $soins_commentaire
     *
     * @return Soins
     */
    public function setSoinsCommentaire($soins_commentaire)
    {
        $this->soins_commentaire = $soins_commentaire;

        return $this;
    }

    /**
     * Get soins_commentaire
     *
     * @return string
     */
    public function getSoinsCommentaire()
    {
        return $this->soins_commentaire;
    }

    /**
     * Set soins_date_enreg
     *
     * @param \DateTime $soins_date_enreg
     *
     * @return Soins
     */
    public function setSoinsDateEnreg($soins_date_enreg)
    {
        $this->soins_date_enreg = $soins_date_enreg;

        return $this;
    }

    /**
     * Get soins_date_enreg
     *
     * @return \DateTime
     */
    public function getSoinsDateEnreg()
    {
        return $this->soins_date_enreg;
    }

    /**
     * Set soins_date_modif
     *
     * @param \DateTime $soins_date_modif
     *
     * @return Soins
     */
    public function setSoinsDateModif($soins_date_modif)
    {
        $this->soins_date_modif = $soins_date_modif;

        return $this;
    }

    /**
     * Get soins_date_modif
     *
     * @return \DateTime
     */
    public function getSoinsDateModif()
    {
        return $this->soins_date_modif;
    }

    /**
     * Set consultation
     *
     * @param \Cmi\ApiBundle\Entity\Consultation $consultation
     *
     * @return Soins
     */
    public function setConsultation(\Cmi\ApiBundle\Entity\Consultation $consultation = null)
    {
        $this->consultation = $consultation;

        return $this;
    }

    /**
     * Get consultation
     *
     * @return \Cmi\ApiBundle\Entity\Consultation
     */
    public function getConsultation()
    {
        return $this->consultation;
    }

    /**
     * Set acte
     *
     * @param \Cmi\ApiBundle\Entity\Acte $acte
     *
     * @return Soins
     */
    public function setActe(\Cmi\ApiBundle\Entity\Acte $acte = null)
    {
        $this->acte = $acte;

        return $this;
    }

    /**
     * Get acte
     *
     * @return \Cmi\ApiBundle\Entity\Acte
     */
    public function getActe()
    {
        return $this->acte;
    }
}
