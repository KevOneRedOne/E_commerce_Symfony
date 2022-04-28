<?php

namespace App\Entity;

use App\Repository\CommentsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentsRepository::class)]
class Comments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $CONTENT;

    #[ORM\Column(type: 'datetime')]
    private $CREATEDAT;

    public function getId(): ?int
    {
        return $this->id;
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
