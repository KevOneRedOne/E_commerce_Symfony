<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $NAME;

    #[ORM\Column(type: 'text')]
    private $DESCRIPTION;

    #[ORM\Column(type: 'float')]
    private $PRICE;

    #[ORM\Column(type: 'string', length: 255)]
    private $IMAGE;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNAME(): ?string
    {
        return $this->NAME;
    }

    public function setNAME(string $NAME): self
    {
        $this->NAME = $NAME;

        return $this;
    }

    public function getDESCRIPTION(): ?string
    {
        return $this->DESCRIPTION;
    }

    public function setDESCRIPTION(string $DESCRIPTION): self
    {
        $this->DESCRIPTION = $DESCRIPTION;

        return $this;
    }

    public function getPRICE(): ?float
    {
        return $this->PRICE;
    }

    public function setPRICE(float $PRICE): self
    {
        $this->PRICE = $PRICE;

        return $this;
    }

    public function getIMAGE(): ?string
    {
        return $this->IMAGE;
    }

    public function setIMAGE(string $IMAGE): self
    {
        $this->IMAGE = $IMAGE;

        return $this;
    }
}
