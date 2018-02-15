<?php
/**
 *  * Created by PhpStorm.
 * User: Tomasz Żewłakow <zewlak@gmail.com>
 * Date: 13.02.2018
 * Time: 22:21
 */

namespace App\Services;

use App\Controller\ProductController;
use App\Repository\ProductRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Pagination service.
 *
 * @author Tomasz Żewłakow <zewlak@gmail.com>
 */
class PaginationService
{
    /**
     * Entity manager.
     *
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * PaginationService constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Check if page isn't out of range.
     *
     * @param int $page
     * @param int $elementsPerPage
     * @param ServiceEntityRepository $repository
     *
     * @return bool
     */
    public function isPageAllowed(int $page, int $elementsPerPage, ServiceEntityRepository $repository): bool
    {
        if ($page < 1) {
            return false;
        }

        $qb = $repository->createQueryBuilder('a');
        $qb->select($qb->expr()->count('a.id'));
        $count = $qb->getQuery()->getSingleScalarResult();

        return ceil($count / $elementsPerPage) - $page >= 0;
    }

    /**
     * Get last allowed page based on elelents count.
     *
     * @param int $elementsPerPage
     * @param ServiceEntityRepository $repository
     *
     * @return int
     */
    public function getLastAllowedPage(int $elementsPerPage, ServiceEntityRepository $repository): int
    {
        $qb = $repository->createQueryBuilder('a');
        $qb->select($qb->expr()->count('a.id'));
        $count = $qb->getQuery()->getSingleScalarResult();

        return ceil($count / $elementsPerPage);
    }
}
