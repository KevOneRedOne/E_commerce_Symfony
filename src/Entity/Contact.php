<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $FIRSTNAME;

    #[ORM\Column(type: 'string', length: 255)]
    private $LASTNAME;

    #[ORM\Column(type: 'string', length: 255)]
    private $EMAIL;

    #[ORM\Column(type: 'text')]
    private $CONTENT;

    #[ORM\Column(type: 'datetime')]
    private $CREATEDAT;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFIRSTNAME(): ?string
    {
        return $this->FIRSTNAME;
    }

    public function setFIRSTNAME(string $FIRSTNAME): self
    {
        $this->FIRSTNAME = $FIRSTNAME;

        return $this;
    }

    public function getLASTNAME(): ?string
    {
        return $this->LASTNAME;
    }

    public function setLASTNAME(string $LASTNAME): self
    {
        $this->LASTNAME = $LASTNAME;

        return $this;
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

    public function getCONTENT(): ?string
    {
        return $this->CONTENT;
    }

    public function setCONTENT(string $CONTENT): self
    {
        $this->CONTENT = $CONTENT;

        return $this;
    }

    public function getCREATEDAT(): ?\DateTimeInterface
    {
        return $this->CREATEDAT;
    }

    public function setCREATEDAT(\DateTimeInterface $CREATEDAT): self
    {
        $this->CREATEDAT = $CREATEDAT;

        return $this;
    }
}
