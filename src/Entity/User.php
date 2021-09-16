<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /** @ORM\Column(type="string", length=500) */
    private $name;

    /** @ORM\Column(type="string") */
    private $email;


    /** @ORM\Column(type="string") */
    private $role;

    /**
     *  @ORM\Column(type="datetime", name="posted_at") */
    private $postedAt;



    public function __construct()
    {
        $this->postedAt = new DateTime(); 
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of postedAt
     */ 
    public function getPostedAt()
    {
        return $this->postedAt;
    }

    /**
     * Set the value of postedAt
     *
     * @return  self
     */ 
    public function setPostedAt($postedAt)
    {
        $this->postedAt = $postedAt;

        return $this;
    }
}
