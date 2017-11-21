<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Forme_medicament
 *
 * @ORM\Table(name="forme_medicament")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\Forme_medicamentRepository")
 */
class Forme_medicament
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
     * @ORM\Column(name="form_medic_code", type="string")
     */
    private $form_medic_code;

    /**
     * @var string
     *
     * @ORM\Column(name="form_medic_libelle", type="string", length=100)
     */
    private $form_medic_libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="form_medic_date_enreg", type="datetime")
     */
    private $form_medic_date_enreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="form_medic_date_modif", type="datetime")
     */
    private $form_medic_date_modif;

    /**
     * @ORM\OneToMany(targetEntity="Medicament", mappedBy="forme_medicament")
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
     * Set form_medic_code
     *
     * @param string $form_medic_code
     *
     * @return Forme_medicament
     */
    public function setFormMedicCode($form_medic_code)
    {
        $this->form_medic_code = $form_medic_code;

        return $this;
    }

    /**
     * Get form_medic_code
     *
     * @return string
     */
    public function getFormMedicCode()
    {
        return $this->form_medic_code;
    }

    /**
     * Set form_medic_libelle
     *
     * @param string $form_medic_libelle
     *
     * @return Forme_medicament
     */
    public function setFormMedicLibelle($form_medic_libelle)
    {
        $this->form_medic_libelle = $form_medic_libelle;

        return $this;
    }

    /**
     * Get form_medic_libelle
     *
     * @return string
     */
    public function getFormMedicLibelle()
    {
        return $this->form_medic_libelle;
    }

    /**
     * Set form_medic_date_enreg
     *
     * @param \DateTime $form_medic_date_enreg
     *
     * @return Forme_medicament
     */
    public function setFormMedicDateEnreg($form_medic_date_enreg)
    {
        $this->form_medic_date_enreg = $form_medic_date_enreg;

        return $this;
    }

    /**
     * Get form_medic_date_enreg
     *
     * @return \DateTime
     */
    public function getFormMedicDateEnreg()
    {
        return $this->form_medic_date_enreg;
    }

    /**
     * Set form_medic_date_modif
     *
     * @param \DateTime $form_medic_date_modif
     *
     * @return Forme_medicament
     */
    public function setFormMedicDateModif($form_medic_date_modif)
    {
        $this->form_medic_date_modif = $form_medic_date_modif;

        return $this;
    }

    /**
     * Get form_medic_date_modif
     *
     * @return \DateTime
     */
    public function getFormMedicDateModif()
    {
        return $this->form_medic_date_modif;
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
     * @return Forme_medicament
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
