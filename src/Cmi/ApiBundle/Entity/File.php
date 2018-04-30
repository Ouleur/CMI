<?php

namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * File
 *
 * @ORM\Table(name="file")
 * @ORM\Entity(repositoryClass="Cmi\ApiBundle\Repository\FileRepository")
 */
class File
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
     * @ORM\Column(name="FileName", type="string", length=255, nullable=true)
     */
    private $fileName;

    /**
     * @var string
     *
     * @ORM\Column(name="ActualName", type="string", length=255, nullable=true)
     */
    private $actualName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CreationTime", type="datetime")
     */
    private $creationTime;


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
     * Set fileName
     *
     * @param string $fileName
     *
     * @return File
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set actualName
     *
     * @param string $actualName
     *
     * @return File
     */
    public function setActualName($actualName)
    {
        $this->actualName = $actualName;

        return $this;
    }

    /**
     * Get actualName
     *
     * @return string
     */
    public function getActualName()
    {
        return $this->actualName;
    }

    /**
     * Set creationTime
     *
     * @param \DateTime $creationTime
     *
     * @return File
     */
    public function setCreationTime($creationTime)
    {
        $this->creationTime = $creationTime;

        return $this;
    }

    /**
     * Get creationTime
     *
     * @return \DateTime
     */
    public function getCreationTime()
    {
        return $this->creationTime;
    }
}
