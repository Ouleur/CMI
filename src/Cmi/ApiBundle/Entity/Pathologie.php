<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pathologie
 *
 * @ORM\Table(name="pathologie")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\PathologieRepository")
 */
class Pathologie
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
     * @ORM\Column(name="patho_code", type="string")
     */
    private $patho_code;

    /**
     * @var string
     *
     * @ORM\Column(name="patho_libelle", type="string")
     */
    private $patho_libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="patho_date_enreg", type="datetime")
     */
    private $patho_date_enreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="patho_date_modif", type="datetime")
     */
    private $patho_date_modif;

    /**
     * @ORM\OneToMany(targetEntity="Diagnostique", mappedBy="pathologie")
     * @var Diagnostique[]
     */
    private $diagnostiques;


    /**
     * @ORM\ManyToOne(targetEntity="Famille_pathologie", inversedBy="pathologie")
     * @var Famille_pathologie
     */
    private $famille_pathologie;


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
     * Set patho_code
     *
     * @param string $patho_code
     *
     * @return Pathologie
     */
    public function setPathoCode($patho_code)
    {
        $this->patho_code = $patho_code;

        return $this;
    }

    /**
     * Get patho_code
     *
     * @return string
     */
    public function getPathoCode()
    {
        return $this->patho_code;
    }

    /**
     * Set patho_libelle
     *
     * @param string $patho_libelle
     *
     * @return Pathologie
     */
    public function setPathoLibelle($patho_libelle)
    {
        $this->patho_libelle = $patho_libelle;

        return $this;
    }

    /**
     * Get patho_libelle
     *
     * @return string
     */
    public function getPathoLibelle()
    {
        return $this->patho_libelle;
    }

    
    /**
     * Set patho_date_enreg
     *
     * @param \DateTime $patho_date_enreg
     *
     * @return Pathologie
     */
    public function setPathoDateEnreg($patho_date_enreg)
    {
        $this->patho_date_enreg = $patho_date_enreg;

        return $this;
    }

    /**
     * Get patho_date_enreg
     *
     * @return \DateTime
     */
    public function getPathoDateEnreg()
    {
        return $this->patho_date_enreg;
    }

    /**
     * Set patho_date_modif
     *
     * @param \DateTime $patho_date_modif
     *
     * @return Pathologie
     */
    public function setPathoDateModif($patho_date_modif)
    {
        $this->patho_date_modif = $patho_date_modif;

        return $this;
    }

    /**
     * Get patho_date_modif
     *
     * @return \DateTime
     */
    public function getPathoDateModif()
    {
        return $this->patho_date_modif;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->diagnostiques = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add diagnostique
     *
     * @param \Cmi\ApiBundle\Entity\Diagnostique $diagnostique
     *
     * @return Pathologie
     */
    public function addDiagnostique(\Cmi\ApiBundle\Entity\Diagnostique $diagnostique)
    {
        $this->diagnostiques[] = $diagnostique;

        return $this;
    }

    /**
     * Remove diagnostique
     *
     * @param \Cmi\ApiBundle\Entity\Diagnostique $diagnostique
     */
    public function removeDiagnostique(\Cmi\ApiBundle\Entity\Diagnostique $diagnostique)
    {
        $this->diagnostiques->removeElement($diagnostique);
    }

    /**
     * Get diagnostiques
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiagnostiques()
    {
        return $this->diagnostiques;
    }

    /**
     * Set famillePathologie
     *
     * @param \Cmi\ApiBundle\Entity\Famille_pathologie $famillePathologie
     *
     * @return Pathologie
     */
    public function setFamillePathologie(\Cmi\ApiBundle\Entity\Famille_pathologie $famillePathologie = null)
    {
        $this->famille_pathologie = $famillePathologie;

        return $this;
    }

    /**
     * Get famillePathologie
     *
     * @return \Cmi\ApiBundle\Entity\Famille_pathologie
     */
    public function getFamillePathologie()
    {
        return $this->famille_pathologie;
    }
}
