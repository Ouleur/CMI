<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Carte
 *
 * @ORM\Table(name="carte",uniqueConstraints={@ORM\UniqueConstraint(name="carte_carteNumero_unique",columns={"carte_numero"})})
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\CarteRepository")
 */
class Carte
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
     * @ORM\Column(name="carte_numero", type="string", length=50)
     */
    private $carteNumero;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="carte_date_delivrance", type="date")
     */
    private $carteDateDelivrance;

    /**
     * @var string
     *
     * @ORM\Column(name="carte_code", type="string", length=100)
     */
    private $carteCode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="carte_date_enreg", type="datetime")
     */
    private $carteDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="carte_date_modif", type="datetime")
     */
    private $carteDateModif;


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
     * Set carteNumero
     *
     * @param string $carteNumero
     *
     * @return Carte
     */
    public function setCarteNumero($carteNumero)
    {
        $this->carteNumero = $carteNumero;

        return $this;
    }

    /**
     * Get carteNumero
     *
     * @return string
     */
    public function getCarteNumero()
    {
        return $this->carteNumero;
    }

    /**
     * Set carteDateDelivrance
     *
     * @param \DateTime $carteDateDelivrance
     *
     * @return Carte
     */
    public function setCarteDateDelivrance($carteDateDelivrance)
    {
        $this->carteDateDelivrance = $carteDateDelivrance;

        return $this;
    }

    /**
     * Get carteDateDelivrance
     *
     * @return \DateTime
     */
    public function getCarteDateDelivrance()
    {
        return $this->carteDateDelivrance;
    }

    /**
     * Set carteCode
     *
     * @param string $carteCode
     *
     * @return Carte
     */
    public function setCarteCode($carteCode)
    {
        $this->carteCode = $carteCode;

        return $this;
    }

    /**
     * Get carteCode
     *
     * @return string
     */
    public function getCarteCode()
    {
        return $this->carteCode;
    }

    /**
     * Set carteDateEnreg
     *
     * @param \DateTime $carteDateEnreg
     *
     * @return Carte
     */
    public function setCarteDateEnreg($carteDateEnreg)
    {
        $this->carteDateEnreg = $carteDateEnreg;

        return $this;
    }

    /**
     * Get carteDateEnreg
     *
     * @return \DateTime
     */
    public function getCarteDateEnreg()
    {
        return $this->carteDateEnreg;
    }

    /**
     * Set carteDateModif
     *
     * @param \DateTime $carteDateModif
     *
     * @return Carte
     */
    public function setCarteDateModif($carteDateModif)
    {
        $this->carteDateModif = $carteDateModif;

        return $this;
    }

    /**
     * Get carteDateModif
     *
     * @return \DateTime
     */
    public function getCarteDateModif()
    {
        return $this->carteDateModif;
    }
}

