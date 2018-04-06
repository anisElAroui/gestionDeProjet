<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 26/03/18
 * Time: 16:30
 */

namespace App\Controller;

use App\Document\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class UserController extends Controller
{
    /**
     * @Route("/Accueil/new", name="app_homepage")
     */
    public function createAction()
    {
        $user = new User();
        $user->setLastName('aroui');
        $user->setRole('PM');

        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->persist($user);
        $dm->flush();

        return new Response('Created user id '.$user->getId());
    }

    public function showAction($id)
    {
        $user = $this->get('doctrine_mongodb')
            ->getRepository('App\Document:User')
            ->find($id);

        if (!$user) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }

        $repository = $this->get('doctrine_mongodb')
            ->getManager()
            ->getRepository('App\Document:User');

        $user = $repository->find($id);
    }

    public function updateAction($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $user = $dm->getRepository('App\Document:User')->find($id);

        if (!$user) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }

        $user->setName('New user name!');
        $dm->flush();

        return $this->redirectToRoute('homepage');
    }

    public function deleteAction($user)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $dm->remove($user);
        $dm->flush();
    }
}