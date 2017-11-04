<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
* @ORM\Entity()
* @ORM\Table(name="pathologie")
*/
class Pathologie
{

	/**
	* @ORM\Id
	- @ORM\Column(type="integer")
	* @ORM\GeneratedValue
	*/
	protected $patho_id;

	/**
	* @ORM\Column(type="string")
	*/
	protected $patho_code;


	/**
	* @ORM\Column(type="string")
	*/
	protected $patho_libelle;


	/**
	* @ORM\Column(type="integer")
	*/

	protected $patho_famille_id;

	/**
	* @ORM\Column(type="date")
	*/
	protected $patho_date_enreg;


	/**
	* @ORM\Column(type="date")
	*/
	protected $patho_date_modif;


	public function getPathoId()
	{
		return $this->patho_id;
	}

	public function getPathoCode()
	{
		return $this->patho_code;
	}

	public function getPathoLibelle()
	{
		return $this->patho_libelle;
	}

	public function getPathoFamilleId()
	{
		return $this->patho_famille_id;
	}

	public function getPathoDateEnreg()
	{
		return $this->patho_date_enreg;
	}

	public function getPathoDateModif()
	{
		return $this->patho_date_modif;
	}


	public function setPathoId($patho_id)
	{
		$this->patho_id = $patho_id;
		return $this;
	}

	public function setPathoCode($patho_code)
	{
		$this->patho_code = $patho_code;
		return $this;
	}

	public function setPathoLibelle($patho_libelle)
	{
		$this->patho_libelle = $patho_libelle;
		return $this;
	}

	public function setPathoFamilleId($patho_famille_id)
	{
		$this->patho_famille_id = $patho_famille_id;
		return $this;
	}

	public function setPathoDateEnreg($patho_date_enreg)
	{
		$this->patho_date_enreg = $patho_date_enreg;
		return $this;
	}

	public function setPathoDateModif($patho_date_modif)
	{
		$this->patho_date_modif = $patho_date_modif;
		return $this;
	}
}