<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 04/05/18
 * Time: 11:19
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class NotificationController extends Controller
{
    /**
     * @Route("/notification", name="notification")
     * @Method({"GET"})
     */
    public function indexAction(Request $request)
    {
        $notifications = $this->get('doctrine_mongodb')->getRepository('App\Document\Notification')->findAll();

        $user = $this->getUser();

        return $this->render('navbar.html.twig', ['notifications' => $notifications,'user'=>$user]);
    }
}