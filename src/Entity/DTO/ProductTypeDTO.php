<?php
/**
 *  * Created by PhpStorm.
 * User: Tomasz Żewłakow <zewlak@gmail.com>
 * Date: 13.02.2018
 * Time: 22:59
 */

namespace App\Entity\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class ProductTypeDTO
{
    /**
     * Name.
     *
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * Description.
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=100)
     */
    private $description;

    /**
     * Price.
     *
     * Max value depends on Entity/Product description field precision.
     *
     * @Assert\NotBlank()
     * @Assert\Range(
     *      min = 0,
     *      max = 99999999.99
     * )
     */
    private $price;

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name.
     *
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set description.
     *
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Get price.
     *
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * Set price.
     *
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}
