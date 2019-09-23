<?php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

     /**
     * @ORM\Column(type="boolean")
     */
    protected $isAdmin;

    public function __construct()
    {
        parent::__construct();
        $this->isAdmin = false;
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsAdmin(): ?int
    {
        return $this->isAdmin;
    }
    public function setIsAdmin(boolean $isAdmin): self
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }
}