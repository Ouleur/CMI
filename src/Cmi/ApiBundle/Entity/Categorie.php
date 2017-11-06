<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\CategorieRepository")
 */
class Categorie
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
     * @ORM\Column(name="cate_code", type="string", length=10)
     */
    private $cateCode;

    /**
     * @var string
     *
     * @ORM\Column(name="cate_libelle", type="string", length=100)
     */
    private $cateLibelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cate_date_enreg", type="datetime")
     */
    private $cateDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cate_date_modif", type="datetime")
     */
    private $cateDateModif;


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
     * Set cateCode
     *
     * @param string $cateCode
     *
     * @return Categorie
     */
    public function setCateCode($cateCode)
    {
        $this->cateCode = $cateCode;

        return $this;
    }

    /**
     * Get cateCode
     *
     * @return string
     */
    public function getCateCode()
    {
        return $this->cateCode;
    }

    /**
     * Set cateLibelle
     *
     * @param string $cateLibelle
     *
     * @return Categorie
     */
    public function setCateLibelle($cateLibelle)
    {
        $this->cateLibelle = $cateLibelle;

        return $this;
    }

    /**
     * Get cateLibelle
     *
     * @return string
     */
    public function getCateLibelle()
    {
        return $this->cateLibelle;
    }

    /**
     * Set cateDateEnreg
     *
     * @param \DateTime $cateDateEnreg
     *
     * @return Categorie
     */
    public function setCateDateEnreg($cateDateEnreg)
    {
        $this->cateDateEnreg = $cateDateEnreg;

        return $this;
    }

    /**
     * Get cateDateEnreg
     *
     * @return \DateTime
     */
    public function getCateDateEnreg()
    {
        return $this->cateDateEnreg;
    }

    /**
     * Set cateDateModif
     *
     * @param \DateTime $cateDateModif
     *
     * @return Categorie
     */
    public function setCateDateModif($cateDateModif)
    {
        $this->cateDateModif = $cateDateModif;

        return $this;
    }

    /**
     * Get cateDateModif
     *
     * @return \DateTime
     */
    public function getCateDateModif()
    {
        return $this->cateDateModif;
    }
}
