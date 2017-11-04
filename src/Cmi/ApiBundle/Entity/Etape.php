<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
* @ORM\Entity()
* @ORM\Table(name="etape")
*/
class Etape
{

	/**
	* @ORM\Id
	- @ORM\Column(type="integer")
	* @ORM\GeneratedValue
	*/
	protected $etp_id;

	/**
	* @ORM\Column(type="string")
	*/
	protected $etp_code;


	/**
	* @ORM\Column(type="string")
	*/
	protected $etp_libelle;


	/**
	* @ORM\Column(type="date")
	*/
	protected $etp_date_enreg;


	/**
	* @ORM\Column(type="date")
	*/
	protected $etp_date_modif;


	public function getEtpId()
	{
		return $this->etp_id;
	}

	public function getEtpCode()
	{
		return $this->etp_code;
	}

	public function getEtpLibelle()
	{
		return $this->etp_libelle;
	}

	public function getEtpDateEnreg()
	{
		return $this->etp_date_enreg;
	}

	public function getEtpDateModif()
	{
		return $this->etp_date_modif;
	}


	public function setEtpId($etp_id)
	{
		$this->etp_id = $etp_id;
		return $this;
	}

	public function setEtpCode($etp_code)
	{
		$this->etp_code = $etp_code;
		return $this;
	}

	public function setEtpLibelle($etp_libelle)
	{
		$this->etp_libelle = $etp_libelle;
		return $this;
	}

	public function setEtpDateEnreg($etp_date_enreg)
	{
		$this->etp_date_enreg = $etp_date_enreg;
		return $this;
	}

	public function setEtpDateModif($etp_date_modif)
	{
		$this->etp_date_modif = $etp_date_modif;
		return $this;
	}
}