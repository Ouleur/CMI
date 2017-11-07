<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Medicament
 *
 * @ORM\Table(name="medicament")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\MedicamentRepository")
 */
class Medicament
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
     * @ORM\Column(name="medic_id", type="integer")
     */
    private $medic_id;

    /**
     * @var string
     *
     * @ORM\Column(name="medic_code", type="string")
     */
    private $medic_code;

    /**
     * @var string
     *
     * @ORM\Column(name="medic_libelle", type="string", length=100)
     */
    private $medic_libelle;

    /**
     * @var int
     *
     * @ORM\Column(name="medic_famille_id", type="integer")
     */
    private $medic_famille_id;

    /**
     * @var int
     *
     * @ORM\Column(name="medic_forme_id", type="integer")
     */
    private $medic_forme_id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="medic_date_enreg", type="datetime")
     */
    private $medic_date_enreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="medic_date_modif", type="datetime")
     */
    private $medic_date_modif;

    /**
     * @ORM\OneToMany(targetEntity="Ordonnance", mappedBy="consultation")
     * @var Ordonnance[]
     */
    protected $ordonnances;


    /**
     * @ORM\ManyToOne(targetEntity="Forme_medicament", inversedBy="medicaments")
     * @var Forme_medicament
     */
    protected $forme_medicament;


    /**
     * @ORM\ManyToOne(targetEntity="Famille_medicament", inversedBy="medicaments")
     * @var Famille_medicament
     */
    protected $famille_medicament;
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
     * Set medic_id
     *
     * @param integer $medic_id
     *
     * @return Medicament
     */
    public function setMedicId($medic_id)
    {
        $this->medic_id = $medic_id;

        return $this;
    }

    /**
     * Get medic_id
     *
     * @return int
     */
    public function getMedicId()
    {
        return $this->medic_id;
    }

    /**
     * Set medic_code
     *
     * @param string $medic_code
     *
     * @return Medicament
     */
    public function setMedicCode($medic_code)
    {
        $this->medic_code = $medic_code;

        return $this;
    }

    /**
     * Get medic_code
     *
     * @return string
     */
    public function getMedicCode()
    {
        return $this->medic_code;
    }

    /**
     * Set medic_libelle
     *
     * @param string $medic_libelle
     *
     * @return Medicament
     */
    public function setMedicLibelle($medic_libelle)
    {
        $this->medic_libelle = $medic_libelle;

        return $this;
    }

    /**
     * Get medic_libelle
     *
     * @return string
     */
    public function getMedicLibelle()
    {
        return $this->medic_libelle;
    }

    /**
     * Set medic_famille_id
     *
     * @param integer $medic_famille_id
     *
     * @return Medicament
     */
    public function setMedicFamilleId($medic_famille_id)
    {
        $this->medic_famille_id = $medic_famille_id;

        return $this;
    }

    /**
     * Get medic_famille_id
     *
     * @return int
     */
    public function getMedicFamilleId()
    {
        return $this->medic_famille_id;
    }

    /**
     * Set medic_forme_id
     *
     * @param integer $medic_forme_id
     *
     * @return Medicament
     */
    public function setMedicFormeId($medic_forme_id)
    {
        $this->medic_forme_id = $medic_forme_id;

        return $this;
    }

    /**
     * Get medic_forme_id
     *
     * @return int
     */
    public function getMedicFormeId()
    {
        return $this->medic_forme_id;
    }

    /**
     * Set medic_date_enreg
     *
     * @param \DateTime $medic_date_enreg
     *
     * @return Medicament
     */
    public function setMedicDateEnreg($medic_date_enreg)
    {
        $this->medic_date_enreg = $medic_date_enreg;

        return $this;
    }

    /**
     * Get medic_date_enreg
     *
     * @return \DateTime
     */
    public function getMedicDateEnreg()
    {
        return $this->medic_date_enreg;
    }

    /**
     * Set medic_date_modif
     *
     * @param \DateTime $medic_date_modif
     *
     * @return Medicament
     */
    public function setMedicDateModif($medic_date_modif)
    {
        $this->medic_date_modif = $medic_date_modif;

        return $this;
    }

    /**
     * Get medic_date_modif
     *
     * @return \DateTime
     */
    public function getMedicDateModif()
    {
        return $this->medic_date_modif;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ordonnances = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ordonnance
     *
     * @param \Cmi\ApiBundle\Entity\Ordonnance $ordonnance
     *
     * @return Medicament
     */
    public function addOrdonnance(\Cmi\ApiBundle\Entity\Ordonnance $ordonnance)
    {
        $this->ordonnances[] = $ordonnance;

        return $this;
    }

    /**
     * Remove ordonnance
     *
     * @param \Cmi\ApiBundle\Entity\Ordonnance $ordonnance
     */
    public function removeOrdonnance(\Cmi\ApiBundle\Entity\Ordonnance $ordonnance)
    {
        $this->ordonnances->removeElement($ordonnance);
    }

    /**
     * Get ordonnances
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrdonnances()
    {
        return $this->ordonnances;
    }

    /**
     * Set formeMedicament
     *
     * @param \Cmi\ApiBundle\Entity\Forme_medicament $formeMedicament
     *
     * @return Medicament
     */
    public function setFormeMedicament(\Cmi\ApiBundle\Entity\Forme_medicament $formeMedicament = null)
    {
        $this->forme_medicament = $formeMedicament;

        return $this;
    }

    /**
     * Get formeMedicament
     *
     * @return \Cmi\ApiBundle\Entity\Forme_medicament
     */
    public function getFormeMedicament()
    {
        return $this->forme_medicament;
    }

    /**
     * Set familleMedicament
     *
     * @param \Cmi\ApiBundle\Entity\Famille_medicament $familleMedicament
     *
     * @return Medicament
     */
    public function setFamilleMedicament(\Cmi\ApiBundle\Entity\Famille_medicament $familleMedicament = null)
    {
        $this->famille_medicament = $familleMedicament;

        return $this;
    }

    /**
     * Get familleMedicament
     *
     * @return \Cmi\ApiBundle\Entity\Famille_medicament
     */
    public function getFamilleMedicament()
    {
        return $this->famille_medicament;
    }
}
