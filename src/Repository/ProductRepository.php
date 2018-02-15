<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Product repository
 *
 * @author Tomasz Żewłakow <zewlak@gmail.com>
 */
class ProductRepository extends ServiceEntityRepository
{
    /**
     * ProductRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }
}
