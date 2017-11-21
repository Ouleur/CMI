<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Famille_medicament
 *
 * @ORM\Table(name="famille_medicament")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\Famille_medicamentRepository")
 */
class Famille_medicament
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
     * @ORM\Column(name="fam_medic_code", type="string")
     */
    private $fam_medic_code;

    /**
     * @var string
     *
     * @ORM\Column(name="fam_medic_libelle", type="string", length=100)
     */
    private $fam_medic_libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fam_medic_date_enreg", type="datetime")
     */
    private $fam_medic_date_enreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fam_medic_date_modif", type="datetime")
     */
    private $fam_medic_date_modif;

    /**
     * @ORM\OneToMany(targetEntity="Medicament", mappedBy="famille_medicament")
     * @var Medicament[]
     */
    private $medicaments;


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
     * Set fam_medic_code
     *
     * @param string $fam_medic_code
     *
     * @return Famille_medicament
     */
    public function setFamMedicCode($fam_medic_code)
    {
        $this->fam_medic_code = $fam_medic_code;

        return $this;
    }

    /**
     * Get fam_medic_code
     *
     * @return string
     */
    public function getFamMedicCode()
    {
        return $this->fam_medic_code;
    }

    /**
     * Set fam_medic_libelle
     *
     * @param string $fam_medic_libelle
     *
     * @return Famille_medicament
     */
    public function setFamMedicLibelle($fam_medic_libelle)
    {
        $this->fam_medic_libelle = $fam_medic_libelle;

        return $this;
    }

    /**
     * Get fam_medic_libelle
     *
     * @return string
     */
    public function getFamMedicLibelle()
    {
        return $this->fam_medic_libelle;
    }

    /**
     * Set fam_medic_date_enreg
     *
     * @param \DateTime $fam_medic_date_enreg
     *
     * @return Famille_medicament
     */
    public function setFamMedicDateEnreg($fam_medic_date_enreg)
    {
        $this->fam_medic_date_enreg = $fam_medic_date_enreg;

        return $this;
    }

    /**
     * Get fam_medic_date_enreg
     *
     * @return \DateTime
     */
    public function getFamMedicDateEnreg()
    {
        return $this->fam_medic_date_enreg;
    }

    /**
     * Set fam_medic_date_modif
     *
     * @param \DateTime $fam_medic_date_modif
     *
     * @return Famille_medicament
     */
    public function setFamMedicDateModif($fam_medic_date_modif)
    {
        $this->fam_medic_date_modif = $fam_medic_date_modif;

        return $this;
    }

    /**
     * Get fam_medic_date_modif
     *
     * @return \DateTime
     */
    public function getFamMedicDateModif()
    {
        return $this->fam_medic_date_modif;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medicaments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add medicament
     *
     * @param \Cmi\ApiBundle\Entity\Medicament $medicament
     *
     * @return Famille_medicament
     */
    public function addMedicament(\Cmi\ApiBundle\Entity\Medicament $medicament)
    {
        $this->medicaments[] = $medicament;

        return $this;
    }

    /**
     * Remove medicament
     *
     * @param \Cmi\ApiBundle\Entity\Medicament $medicament
     */
    public function removeMedicament(\Cmi\ApiBundle\Entity\Medicament $medicament)
    {
        $this->medicaments->removeElement($medicament);
    }

    /**
     * Get medicaments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMedicaments()
    {
        return $this->medicaments;
    }
}
