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

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $user_id;

    #[ORM\ManyToOne(targetEntity: Product::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $product_id;

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

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getProductId(): ?Product
    {
        return $this->product_id;
    }

    public function setProductId(?Product $product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }
}
