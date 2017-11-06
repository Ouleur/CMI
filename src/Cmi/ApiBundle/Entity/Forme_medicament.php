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
     * @var int
     *
     * @ORM\Column(name="form_medic_id", type="integer")
     */
    private $form_medic_id;

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set form_medic_id
     *
     * @param integer $form_medic_id
     *
     * @return Forme_medicament
     */
    public function setFormMedicId($form_medic_id)
    {
        $this->form_medic_id = $form_medic_id;

        return $this;
    }

    /**
     * Get form_medic_id
     *
     * @return int
     */
    public function getFormMedicId()
    {
        return $this->form_medic_id;
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
}
