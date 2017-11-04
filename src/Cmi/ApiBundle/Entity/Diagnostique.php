<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
* @ORM\Entity()
* @ORM\Table(name="diagnostique")
*/
class Diagnostique
{

	/**
	* @ORM\Id
	- @ORM\Column(type="integer")
	* @ORM\GeneratedValue
	*/
	protected $diagn_id;

	/**
	* @ORM\Column(type="integer")
	*/
	protected $diagn_cause_id;


	/**
	* @ORM\Column(type="integer")
	*/
	protected $diagn_consul_id;


	/*
	* @ORM\Column(type="string")
	*
	*/
	protected $diagn_comment;

	/**
	* @ORM\Column(type="date")
	*/
	protected $diagn_date_enreg;


	/**
	* @ORM\Column(type="date")
	*/
	protected $diagn_date_modif;


	public function getDiagnId()
	{
		return $this->diagn_id;
	}

	public function getDiagnCauseId()
	{
		return $this->diagn_cause_id;
	}

	public function getDiagnConsulId()
	{
		return $this->diagn_consul_id;
	}

	public function getDiagnComment()
	{
		return $this->diagn_comment;
	}

	public function getDiagnDateEnreg()
	{
		return $this->diagn_date_enreg;
	}

	public function getDiagnDateModif()
	{
		return $this->diagn_date_modif;
	}


	public function setDiagnId($diagn_id)
	{
		$this->diagn_id = $diagn_id;
		return $this;
	}

	public function setDiagnCauseId($diagn_cause_id)
	{
		$this->diagn_cause_id = $diagn_cause_id;
		return $this;
	}

	public function setDiagnConsulId($diagn_consul_id)
	{
		$this->diagn_consul_id = $diagn_consul_id;
		return $this;
	}

	public function setDiagnComment($diagn_comment)
	{
		$this->diagn_comment = $diagn_comment;
		return $this;
	}

	public function setDiagnDateEnreg($diagn_date_enreg)
	{
		$this->diagn_date_enreg = $diagn_date_enreg;
		return $this;
	}

	public function setDiagnDateModif($diagn_date_modif)
	{
		$this->diagn_date_modif = $diagn_date_modif;
		return $this;
	}
}