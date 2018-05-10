<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 23/04/18
 * Time: 15:55
 */

namespace App\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ProfileController extends Controller
{

    /**
     * @Route("project/user", name="profile_show")
     * @Method({"GET"})
     */
    public function showAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('Profile/show.html.twig', array(
            'user' => $user
        ));
    }

    /**
     * @Route("project/user/edit", name="profile_edit")
     * @Method({"GET","POST"})
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();

//        $editForm = $this->createForm('App\Form\ReportType', $report);
//        $editForm->handleRequest($request);
//
//        if ($editForm->isSubmitted() && $editForm->isValid()) {
//            $dm = $this->get('doctrine_mongodb')->getManager();
//            $dm->persist($report);
//            $dm->flush();
//
//            return $this->redirectToRoute('profile_show');
//        }


        return $this->render('Profile/edit.html.twig', array(
//            'form' => $editForm->createView(),
            'user' => $user
        ));
    }

}