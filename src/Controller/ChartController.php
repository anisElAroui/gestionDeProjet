<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 09/05/18
 * Time: 10:02
 */

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ChartController extends Controller
{

    /**
     * @Route("project/charts", name="chart_index")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        return $this->render('Chart/index.html.twig');
    }
}