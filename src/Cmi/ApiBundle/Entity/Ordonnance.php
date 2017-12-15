<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

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
     * @Serializer\Groups({"consultation","ordonnance"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ordo_dure", type="string")
     * @Serializer\Groups({"consultation","ordonnance"})
     */
    private $ordo_dure;

    /**
     * @var string
     *
     * @ORM\Column(name="ordo_quantite", type="string")
     * @Serializer\Groups({"consultation","ordonnance"})
     */
    private $ordo_quantite;


    /**
     * @var string
     *
     * @ORM\Column(name="ordo_posologie", type="string")
     * @Serializer\Groups({"consultation","ordonnance"})
     */
    private $ordo_posologie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ordo_date_enreg", type="datetime")
     * @Serializer\Groups({"consultation","ordonnance"})
     */
    private $ordo_date_enreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ordo_date_modif", type="datetime")
     * @Serializer\Groups({"consultation","ordonnance"})
     */
    private $ordo_date_modif;


    /**
     * @ORM\ManyToOne(targetEntity="Medicament", inversedBy="ordonnances")
     * @var Medicament
     * @Serializer\Groups({"consultation","ordonnance"})
     */
    private $medicament;

    /**
     * @ORM\ManyToOne(targetEntity="Consultation", inversedBy="ordonnances")
     * @var Consultation
     * @Serializer\Groups({"ordonnance"})
     */
    private $consultation;

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

    /**
     * Set medicament
     *
     * @param \Cmi\ApiBundle\Entity\Medicament $medicament
     *
     * @return Ordonnance
     */
    public function setMedicament(\Cmi\ApiBundle\Entity\Medicament $medicament = null)
    {
        $this->medicament = $medicament;

        return $this;
    }

    /**
     * Get medicament
     *
     * @return \Cmi\ApiBundle\Entity\Medicament
     */
    public function getMedicament()
    {
        return $this->medicament;
    }

    /**
     * Set consultation
     *
     * @param \Cmi\ApiBundle\Entity\Consultation $consultation
     *
     * @return Ordonnance
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
     * Set ordoDure
     *
     * @param string $ordoDure
     *
     * @return Ordonnance
     */
    public function setOrdoDure($ordoDure)
    {
        $this->ordo_dure = $ordoDure;

        return $this;
    }

    /**
     * Get ordoDure
     *
     * @return string
     */
    public function getOrdoDure()
    {
        return $this->ordo_dure;
    }

    /**
     * Set ordoQuantite
     *
     * @param string $ordoQuantite
     *
     * @return Ordonnance
     */
    public function setOrdoQuantite($ordoQuantite)
    {
        $this->ordo_quantite = $ordoQuantite;

        return $this;
    }

    /**
     * Get ordoQuantite
     *
     * @return string
     */
    public function getOrdoQuantite()
    {
        return $this->ordo_quantite;
    }
}
