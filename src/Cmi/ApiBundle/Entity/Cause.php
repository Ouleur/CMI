<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
* @ORM\Entity()
* @ORM\Table(name="cause")
*/
class Cause
{

	/**
	* @ORM\Id
	- @ORM\Column(type="integer")
	* @ORM\GeneratedValue
	*/
	protected $cause_id;

	/**
	* @ORM\Column(type="string")
	*/
	protected $cause_code;


	/**
	* @ORM\Column(type="string")
	*/
	protected $cause_libelle;


	/**
	* @ORM\Column(type="date")
	*/
	protected $cause_date_enreg;


	/**
	* @ORM\Column(type="date")
	*/
	protected $cause_date_modif;


	public function getCauseId()
	{
		return $this->cause_id;
	}

	public function getCauseCode()
	{
		return $this->cause_code;
	}

	public function getCauseLibelle()
	{
		return $this->cause_libelle;
	}

	public function getCauseDateEnreg()
	{
		return $this->cause_date_enreg;
	}

	public function getCauseDateModif()
	{
		return $this->cause_date_modif;
	}


	public function setCauseId($cause_id)
	{
		$this->cause_id = $cause_id;
		return $this;
	}

	public function setCauseCode($cause_code)
	{
		$this->cause_code = $cause_code;
		return $this;
	}

	public function setCauseLibelle($cause_libelle)
	{
		$this->cause_libelle = $cause_libelle;
		return $this;
	}

	public function setCauseDateEnreg($cause_date_enreg)
	{
		$this->cause_date_enreg = $cause_date_enreg;
		return $this;
	}

	public function setCauseDateModif($cause_date_modif)
	{
		$this->cause_date_modif = $cause_date_modif;
		return $this;
	}
}