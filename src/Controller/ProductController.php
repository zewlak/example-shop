<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Services\PaginationService;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Number of elements shown in pagination.
     *
     * @var int
     */
    public const PRODUCTS_PER_PAGE = 10;

    /**
     * EntityManager.
     *
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * Pagination service.
     *
     * @var PaginationService
     */
    private $paginationService;

    /**
     * ProductController constructor.
     *
     * @param EntityManagerInterface $em
     * @param PaginationService $paginationService
     */
    public function __construct(
        EntityManagerInterface $em,
        PaginationService $paginationService
    ) {
        $this->em = $em;
        $this->paginationService = $paginationService;
    }

    /**
     * List products.
     *
     * @param Request
     *
     * @return Response
     *
     * @Route("/product", name="product")
     */
    public function indexAction(Request $request): Response
    {
        $page = $request->query->getInt('page', 1);

        /** @var ProductRepository $productRepository */
        $productRepository = $this->em->getRepository(Product::class);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $productRepository->findAll(),
            //show last allowed page elements, consider redirecting to last allowed page
            $this->paginationService->isPageAllowed($page, $this::PRODUCTS_PER_PAGE, $productRepository)
                ? $page
                : $this->paginationService->getLastAllowedPage($this::PRODUCTS_PER_PAGE, $productRepository),
            $this::PRODUCTS_PER_PAGE,
            array('defaultSortFieldName' => 'created_at', 'defaultSortDirection' => 'desc')
        );

        return $this->render('Product/list.html.twig', array('pagination' => $pagination));
    }
}
