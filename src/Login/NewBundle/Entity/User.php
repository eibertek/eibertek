<?php

namespace Login\NewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use \Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;    
/**
 * Login\NewBundle\Entity\User
 *
 * @ORM\Table(name="login_users")
 * @ORM\Entity(repositoryClass="Login\NewBundle\Entity\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    public function __construct()
    {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid(null, true));
    }


    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }
    /**
     * @inheritDoc
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    
     /**
     * @inheritDoc
     */
    public function getisActive()
    {
        return $this->isActive;
    }

    public function setisActive($active)
    {
        $this->isActive=$active;
    }
    
    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($passwordunencrypted)
    {
               
        $this->password = md5($passwordunencrypted); 
                //password_hash($passwordunencrypted, PASSWORD_BCRYPT, array('cost' => 13));
        
    }
    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id, 
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }
}   