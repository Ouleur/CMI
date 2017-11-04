<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
* @ORM\Entity()
* @ORM\Table(name="famille_pathologie")
*/
class Famille_pathologie
{

	/**
	* @ORM\Id
	- @ORM\Column(type="integer")
	* @ORM\GeneratedValue
	*/
	protected $fam_patho_id;

	/**
	* @ORM\Column(type="string")
	*/
	protected $fam_patho_code;


	/**
	* @ORM\Column(type="string")
	*/
	protected $fam_patho_libelle;


	/**
	* @ORM\Column(type="date")
	*/
	protected $fam_patho_date_enreg;


	/**
	* @ORM\Column(type="date")
	*/
	protected $fam_patho_date_modif;


	public function getFamPathoId()
	{
		return $this->fam_patho_id;
	}

	public function getFamPathoCode()
	{
		return $this->fam_patho_code;
	}

	public function getFamPathoLibelle()
	{
		return $this->fam_patho_libelle;
	}

	public function getFamPathoDateEnreg()
	{
		return $this->fam_patho_date_enreg;
	}

	public function getFamPathoDateModif()
	{
		return $this->fam_patho_date_modif;
	}


	public function setFamPathoId($fam_patho_id)
	{
		$this->fam_patho_id = $fam_patho_id;
		return $this;
	}

	public function setFamPathoCode($fam_patho_code)
	{
		$this->fam_patho_code = $fam_patho_code;
		return $this;
	}

	public function setFamPathoLibelle($fam_patho_libelle)
	{
		$this->fam_patho_libelle = $fam_patho_libelle;
		return $this;
	}

	public function setFamPathoDateEnreg($fam_patho_date_enreg)
	{
		$this->fam_patho_date_enreg = $fam_patho_date_enreg;
		return $this;
	}

	public function setFamPathoDateModif($fam_patho_date_modif)
	{
		$this->fam_patho_date_modif = $fam_patho_date_modif;
		return $this;
	}
}