<?php
/**
 *  * Created by PhpStorm.
 * User: Tomasz Żewłakow <zewlak@gmail.com>
 * Date: 13.02.2018
 * Time: 17:15
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    /**
     * Index action.
     *
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->redirectToRoute('product');
    }
}
