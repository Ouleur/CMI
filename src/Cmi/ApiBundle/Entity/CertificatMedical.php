<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CertificatMedical
 *
 * @ORM\Table(name="certificat_medical")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\CertificatMedicalRepository")
 */
class CertificatMedical
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
     * @ORM\Column(name="cm_url", type="string", length=255)
     */
    private $cmUrl;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cm_date_enreg", type="datetime")
     */
    private $cmDateEnreg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cm_date_modif", type="datetime")
     */
    private $cmDateModif;


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
     * Set cmUrl
     *
     * @param string $cmUrl
     *
     * @return CertificatMedical
     */
    public function setCmUrl($cmUrl)
    {
        $this->cmUrl = $cmUrl;

        return $this;
    }

    /**
     * Get cmUrl
     *
     * @return string
     */
    public function getCmUrl()
    {
        return $this->cmUrl;
    }

    /**
     * Set cmDateEnreg
     *
     * @param \DateTime $cmDateEnreg
     *
     * @return CertificatMedical
     */
    public function setCmDateEnreg($cmDateEnreg)
    {
        $this->cmDateEnreg = $cmDateEnreg;

        return $this;
    }

    /**
     * Get cmDateEnreg
     *
     * @return \DateTime
     */
    public function getCmDateEnreg()
    {
        return $this->cmDateEnreg;
    }

    /**
     * Set cmDateModif
     *
     * @param \DateTime $cmDateModif
     *
     * @return CertificatMedical
     */
    public function setCmDateModif($cmDateModif)
    {
        $this->cmDateModif = $cmDateModif;

        return $this;
    }

    /**
     * Get cmDateModif
     *
     * @return \DateTime
     */
    public function getCmDateModif()
    {
        return $this->cmDateModif;
    }
}
