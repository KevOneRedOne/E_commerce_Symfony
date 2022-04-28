<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $EMAIL;

    #[ORM\Column(type: 'string', length: 255)]
    private $USERNAME;

    #[ORM\Column(type: 'string', length: 255)]
    private $PASSWORD;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEMAIL(): ?string
    {
        return $this->EMAIL;
    }

    public function setEMAIL(string $EMAIL): self
    {
        $this->EMAIL = $EMAIL;

        return $this;
    }

    public function getUSERNAME(): ?string
    {
        return $this->USERNAME;
    }

    public function setUSERNAME(string $USERNAME): self
    {
        $this->USERNAME = $USERNAME;

        return $this;
    }

    public function getPASSWORD(): ?string
    {
        return $this->PASSWORD;
    }

    public function setPASSWORD(string $PASSWORD): self
    {
        $this->PASSWORD = $PASSWORD;

        return $this;
    }
}
