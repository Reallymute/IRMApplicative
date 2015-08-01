<?php

namespace Grdf\GaiaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Grdf\GaiaBundle\Entity\User
 *
 * @ORM\Table(name="gaia_user")
 * @ORM\Entity(repositoryClass="Grdf\GaiaBundle\Repository\UserRepository")
 */
class User
{

    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Le GAIA doit être renseigné.")
     */
    protected $gaia;

    /**
     * @ORM\Column(name="first_name", type="string", nullable=true)
     * @Assert\NotBlank(message="Le prénom doit être renseigné.")
     */
    protected $firstName;

    /**
     * @ORM\Column(name="last_name", type="string", nullable=true)
     * @Assert\NotBlank(message="Le nom doit être renseigné.")
     */
    protected $lastName;

    /**
     * @ORM\Column(name="email", type="string", nullable=true)
     * @Assert\NotBlank(message="L'email doit être renseigné.")
     * @Assert\Email(message="L'email n'est pas valide.")
     */
    protected $email;

    /**
     * @ORM\Column(name="receive_emails", type="boolean")
     */
    protected $receiveEmails = true;

    /**
     * @ORM\ManyToOne(targetEntity="Group")
     * @Assert\NotBlank(message="Le groupe doit être renseigné.")
     */
    protected $group;

    /**
     * Set gaia
     *
     * @param string $gaia
     * @return User
     */
    public function setGaia($gaia)
    {
        $this->gaia = strtoupper($gaia);

        return $this;
    }

    /**
     * Get gaia
     *
     * @return string
     */
    public function getGaia()
    {
        return $this->gaia;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set receiveEmails
     *
     * @param boolean $receiveEmails
     * @return User
     */
    public function setReceiveEmails($receiveEmails)
    {
        $this->receiveEmails = $receiveEmails;

        return $this;
    }

    /**
     * Get receiveEmails
     *
     * @return boolean
     */
    public function getReceiveEmails()
    {
        return $this->receiveEmails;
    }

    /**
     * Set group
     *
     * @param \Grdf\GaiaBundle\Entity\Group $group
     * @return User
     */
    public function setGroup(\Grdf\GaiaBundle\Entity\Group $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \Grdf\GaiaBundle\Entity\Group
     */
    public function getGroup()
    {
        return $this->group;
    }

}
