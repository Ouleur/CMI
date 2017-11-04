<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
* @ORM\Entity()
* @ORM\Table(name="famille_medicament")
*/
class Famille_medicament
{

	/**
	* @ORM\Id
	- @ORM\Column(type="integer")
	* @ORM\GeneratedValue
	*/
	protected $fam_medic_id;

	/**
	* @ORM\Column(type="string")
	*/
	protected $fam_medic_code;


	/**
	* @ORM\Column(type="string")
	*/
	protected $fam_medic_libelle;


	/**
	* @ORM\Column(type="date")
	*/
	protected $fam_medic_date_enreg;


	/**
	* @ORM\Column(type="date")
	*/
	protected $fam_medic_date_modif;


	public function getFamMedicId()
	{
		return $this->fam_medic_id;
	}

	public function getFamMedicCode()
	{
		return $this->fam_medic_code;
	}

	public function getFamMedicLibelle()
	{
		return $this->fam_medic_libelle;
	}

	public function getFamMedicDateEnreg()
	{
		return $this->fam_medic_date_enreg;
	}

	public function getFamMedicDateModif()
	{
		return $this->fam_medic_date_modif;
	}


	public function setFamMedicId($fam_medic_id)
	{
		$this->fam_medic_id = $fam_medic_id;
		return $this;
	}

	public function setFamMedicCode($fam_medic_code)
	{
		$this->fam_medic_code = $fam_medic_code;
		return $this;
	}

	public function setFamMedicLibelle($fam_medic_libelle)
	{
		$this->fam_medic_libelle = $fam_medic_libelle;
		return $this;
	}

	public function setFamMedicDateEnreg($fam_medic_date_enreg)
	{
		$this->fam_medic_date_enreg = $fam_medic_date_enreg;
		return $this;
	}

	public function setFamMedicDateModif($fam_medic_date_modif)
	{
		$this->fam_medic_date_modif = $fam_medic_date_modif;
		return $this;
	}
}