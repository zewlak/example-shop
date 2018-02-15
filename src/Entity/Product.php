<?php

namespace App\Entity;

use App\Entity\DTO\ProductTypeDTO;
use Doctrine\ORM\Mapping as ORM;

/**
 * Product entity.
 *
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Product
{
    /**
     * Id.
     *
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Name.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * Description.
     *
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * Price.
     *
     * @var double
     *
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * Creation date.
     *
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * Modification date.
     *
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * Create Product from ProductTypeDTO.
     *
     * @param ProductTypeDTO $productDTO
     *
     * @return Product
     */
    public static function createProductFromProductTypeDTO(ProductTypeDTO $productDTO): self
    {
        $product = new self();
        $product->name = $productDTO->getName();
        $product->price = $productDTO->getPrice();
        $product->description = $productDTO->getDescription();

        return $product;
    }

    /**
     * Auto fill timestamps.
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updateTimestamps(): void
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Get creation date.
     *
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * Set creation date.
     *
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get creation time.
     *
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * Set modification time.
     *
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get price.
     *
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Products are created only from create-product Form using ProductTypeDTO.
     * Please change accessibility carefully.
     *
     * Product constructor.
     *
     */
    private function __construct()
    {
    }
}
