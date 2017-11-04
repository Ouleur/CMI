<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
* @ORM\Entity()
* @ORM\Table(name="forme_medicament")
*/
class Forme_medicament
{

	/**
	* @ORM\Id
	- @ORM\Column(type="integer")
	* @ORM\GeneratedValue
	*/
	protected $form_medic_id;

	/**
	* @ORM\Column(type="string")
	*/
	protected $form_medic_code;


	/**
	* @ORM\Column(type="string")
	*/
	protected $form_medic_libelle;


	/**
	* @ORM\Column(type="date")
	*/
	protected $form_medic_date_enreg;


	/**
	* @ORM\Column(type="date")
	*/
	protected $form_medic_date_modif;


	public function getFormMedicId()
	{
		return $this->form_medic_id;
	}

	public function getFormMedicCode()
	{
		return $this->form_medic_code;
	}

	public function getFormMedicLibelle()
	{
		return $this->form_medic_libelle;
	}

	public function getFormMedicDateEnreg()
	{
		return $this->form_medic_date_enreg;
	}

	public function getFormMedicDateModif()
	{
		return $this->form_medic_date_modif;
	}


	public function setFormMedicId($form_medic_id)
	{
		$this->form_medic_id = $form_medic_id;
		return $this;
	}

	public function setFormMedicCode($form_medic_code)
	{
		$this->form_medic_code = $form_medic_code;
		return $this;
	}

	public function setFormMedicLibelle($form_medic_libelle)
	{
		$this->form_medic_libelle = $form_medic_libelle;
		return $this;
	}

	public function setFormMedicDateEnreg($form_medic_date_enreg)
	{
		$this->form_medic_date_enreg = $form_medic_date_enreg;
		return $this;
	}

	public function setFormMedicDateModif($form_medic_date_modif)
	{
		$this->form_medic_date_modif = $form_medic_date_modif;
		return $this;
	}
}