<?php
/**
 *  * Created by PhpStorm.
 * User: Tomasz Żewłakow <zewlak@gmail.com>
 * Date: 15.02.2018
 * Time: 17:09
 */

namespace App\Events;

use App\Entity\DTO\ProductTypeDTO;
use Symfony\Component\EventDispatcher\Event;

/**
 * Event dispatched on product creation.
 *
 * @author Tomasz Żewłakow <zewlak@gmail.com>
 */
class ProductCreatedEvent extends Event
{
    /**
     * Event name.
     *
     * @var string
     */
    const NAME = 'product.created';

    /**
     * Product DTO.
     *
     * @var ProductTypeDTO
     */
    protected $product;

    /**
     * ProductCreatedEvent constructor.
     *
     * @param ProductTypeDTO $product
     */
    public function __construct(ProductTypeDTO $product)
    {
        $this->product = $product;
    }

    /**
     * Get product entity.
     *
     * @return ProductTypeDTO
     */
    public function getProduct(): ProductTypeDTO
    {
        return $this->product;
    }
}
