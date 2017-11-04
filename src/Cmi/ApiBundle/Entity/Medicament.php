<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
* @ORM\Entity()
* @ORM\Table(name="medicament")
*/
class Medicament
{

	/**
	* @ORM\Id
	- @ORM\Column(type="integer")
	* @ORM\GeneratedValue
	*/
	protected $medic_id;

	/**
	* @ORM\Column(type="string")
	*/
	protected $medic_code;


	/**
	* @ORM\Column(type="string")
	*/
	protected $medic_libelle;


	/**
	* @ORM\Column(type="integer")
	*/

	protected $medic_famille_id;

	/**
	* @ORM\Column(type="integer")
	*
	*/

	protected $medic_forme_id;

	/**
	* @ORM\Column(type="date")
	*/
	protected $medic_date_enreg;


	/**
	* @ORM\Column(type="date")
	*/
	protected $medic_date_modif;


	public function getMedicId()
	{
		return $this->medic_id;
	}

	public function getMedicCode()
	{
		return $this->medic_code;
	}

	public function getMedicLibelle()
	{
		return $this->medic_libelle;
	}

	public function getMedicFamilleId()
	{
		return $this->medic_famille_id;
	}

	public function getMedicFormeId()
	{
		return $this->medic_forme_id;
	}
	
	public function getMedicDateEnreg()
	{
		return $this->medic_date_enreg;
	}

	public function getMedicDateModif()
	{
		return $this->medic_date_modif;
	}

	public function setMedicId($medic_id)
	{
		$this->medic_id = $medic_id;
		return $this;
	}

	public function setMedicCode($medic_code)
	{
		$this->medic_code = $medic_code;
		return $this;
	}

	public function setMedicLibelle($medic_libelle)
	{
		$this->medic_libelle = $medic_libelle;
		return $this;
	}

	public function setMedicFamilleId($medic_famille_id)
	{
		$this->medic_famille_id = $medic_famille_id;
		return $this;
	}

	public function setMedicFormeId($medic_forme_id)
	{
		$this->medic_forme_id = $medic_forme_id;
		return $this;
	}

	public function setMedicDateEnreg($medic_date_enreg)
	{
		$this->medic_date_enreg = $medic_date_enreg;
		return $this;
	}

	public function setMedicDateModif($medic_date_modif)
	{
		$this->medic_date_modif = $medic_date_modif;
		return $this;
	}
}