<?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ProductRepository::class)]

/**
 * @Vich\Uploadable
 */
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Length(min:10,max:255,minMessage:"Pas assez de caractères. Le titre doit comporter au moins {{limit}} caractères.")]
    #[Assert\NotBlank(message:"Un produit doit avoir un nom.")]
    private $NAME;

    #[Assert\Length(min:10,minMessage:"Pas assez de caractères. La description doit contenir au moins {{limit}} caractères.")]
    #[Assert\NotBlank(message:"Un produit doit avoir une description.")]
    #[ORM\Column(type: 'text')]
    private $DESCRIPTION;

    #[ORM\Column(type: 'float')]
    private $PRICE;

    #[ORM\Column(type: 'string', length: 255)]
    private $IMAGE;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $category_id;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $user_id;

   /**
    * @Vich\UploadableField(mapping="products_images",fileNameProperty="image")
    */
    private $imageFile;

    #[ORM\Column(type: 'datetime')]
    private $updated_at;

    

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

    public function setIMAGE(?string $IMAGE): self
    {
        $this->IMAGE = $IMAGE;

        return $this;
    }

    public function getCategoryId(): ?Category
    {
        return $this->category_id;
    }

    public function setCategoryId(?Category $category_id): self
    {
        $this->category_id = $category_id;

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

    public function getImageFile() : ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null) : self
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }


    public function __toString()
    {
        return $this->NAME;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
