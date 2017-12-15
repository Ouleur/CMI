<?php
namespace Cmi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity()
 * @ORM\Table(name="auth_tokens",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="auth_tokens_value_unique", columns={"value"})}
 * )
 */
class AuthToken
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @Serializer\Groups({"auth-token"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Serializer\Groups({"auth-token"})
     */
    protected $value;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     * @Serializer\Groups({"auth-token"})
     */
    protected $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @var User
     * @Serializer\Groups({"auth-token"})
     */
    protected $user;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return AuthToken
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return AuthToken
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set user
     *
     * @param \Cmi\ApiBundle\Entity\User $user
     *
     * @return AuthToken
     */
    public function setUser(\Cmi\ApiBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Cmi\ApiBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
