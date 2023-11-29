<?php

// src/DTO/UserWithLikesAndWodDTO.php
namespace App\DTO;

use Symfony\Component\Serializer\Annotation\Groups;

class UserWithLikesAndWodDTO
{
    /**
     * @Groups({"user_read"})
     */
    private $id;

    /**
     * @Groups({"user_read"})
     */
    private $username;

    /**
     * @Groups({"user_read"})
     */
    private $email;

    /**
     * @Groups({"user_read"})
     */
    private $wodIdLiked;

    /**
     * @Groups({"user_read"})
     */
    private $saves;

    /**
     * @Groups({"user_read"})
     */
    private $createdWods;
    

    public function __construct($id, $username, $email, $wodIdLiked, $saves, $createdWods)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->wodIdLiked = $wodIdLiked;
        $this->saves = $saves;
        $this->createdWods = $createdWods;

    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getwodIdLiked()
    {
        return $this->wodIdLiked;
    }
    
    public function getSaves()
    {
        return $this->saves;
    }

    public function getCreatedWods()
    {
        return $this->createdWods;
    }
}
