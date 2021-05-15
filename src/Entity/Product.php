<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use App\Utilities\TimeStampTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Product
{
    use TimeStampTrait ;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $catalogue;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     */
    private $Category;

    /**
     * @ORM\OneToOne(targetEntity=Media::class, cascade={"persist", "remove"})
     */
    private $Media;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCatalogue(): ?string
    {
        return $this->catalogue;
    }

    public function setCatalogue(string $catalogue): self
    {
        $this->catalogue = $catalogue;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->Category;
    }

    public function setCategory(?Category $Category): self
    {
        $this->Category = $Category;

        return $this;
    }

    public function getMedia(): ?Media
    {
        return $this->Media;
    }

    public function setMedia(?Media $Media): self
    {
        $this->Media = $Media;

        return $this;
    }
}
