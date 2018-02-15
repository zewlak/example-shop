<?php
/**
 *  * Created by PhpStorm.
 * User: Tomasz Żewłakow <zewlak@gmail.com>
 * Date: 13.02.2018
 * Time: 17:20
 */

namespace App\Controller;

use App\Entity\DTO\ProductTypeDTO;
use App\Entity\Product;
use App\Events\ProductCreatedEvent;
use App\Forms\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * Entity manager.
     *
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * Event dispatcher.
     *
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * AdminController constructor.
     *
     * @param EntityManagerInterface $em
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EntityManagerInterface $em, EventDispatcherInterface $eventDispatcher)
    {
        $this->em = $em;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * Create new product.
     *
     * @param Request $request
     *
     * @return Response
     *
     * @Route("/admin/new-product", name="admin_new_product")
     */
    public function newAction(Request $request): Response
    {
        $productDTO = new ProductTypeDTO();

        $form = $this->createForm(ProductType::class, $productDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var ProductTypeDTO $productDTO */
            $productDTO = $form->getData();

            $this->em->persist(Product::createProductFromProductTypeDTO($productDTO));
            $this->em->flush();

            $this->eventDispatcher->dispatch(
                ProductCreatedEvent::NAME,
                new ProductCreatedEvent($productDTO)
            );

            $success = true;
        }

        return $this->render('Product/new.html.twig', array(
            'form' => $form->createView(),
            'success' => $success ?? false
        ));
    }
}