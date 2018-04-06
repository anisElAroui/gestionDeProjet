<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 05/04/18
 * Time: 09:44
 */

namespace App\Controller;

use App\Document\Charter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\CharterType;
use DateTime;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class CharterController extends Controller
{

    /**
     * @Route("/charter", name="charter_index")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        $charter = $this->get('doctrine_mongodb')->getRepository('App\Document\Charter')->findOneById("5ac6a28d1ea6e36bfd74dd32");

        return $this->render('Charter/index.html.twig', ['charter' => $charter,]);
    }

    /**
     * @Route("/charter/new", name="charter_new")
     * @Method({"POST","GET"})
     */
    public function newAction(Request $request)
    {
        $charter = new Charter();
        $form = $this->createForm('App\Form\CharterType', $charter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($charter);
            $dm->flush();

            return $this->redirectToRoute('charter_index', array('id' => $charter->getId()));
        }

        return $this->render('Charter/new.html.twig', array(
            'charter' => $charter,
            'form' => $form->createView(),
        ));
    }


//    /**
//     * @Route("/charter/{id}/show", name="charter_show")
//     * @Method({"GET","DELETE"})
//     */
//    public function showAction(Request $request, $id)
//    {
//        $dm = $this->get('doctrine_mongodb')->getManager();
//        $charter = $dm->getRepository('App\Document\Charter')->findOneBy(array('id' => $id));
//
//        $deleteForm = $this->createDeleteForm($id);
//
//        $deleteForm->handleRequest($request);
//
//        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
//            $dm = $this->get('doctrine_mongodb')->getManager();
//            $dm->remove($charter);
//            $dm->flush();
//
//            return $this->redirectToRoute('charter_index');
//        }
//
//
//        return $this->render('Charter/show.html.twig', array(
//            'charter' => $charter,
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }
//
//
//    /**
//     *
//     * @Route("/charter/{id}/edit", name="charter_edit")
//     * @Method({"GET","POST"})
//     */
//    public function editAction(Request $request, $id)
//    {
//
//        $dm = $this->get('doctrine_mongodb')->getManager();
//        $charter = $dm->getRepository('App\Document\Charter')->findOneBy(array('id' => $id));
//
//        $editForm = $this->createForm('App\Form\CharterType', $charter);
//        $editForm->handleRequest($request);
//
//        if ($editForm->isSubmitted() && $editForm->isValid()) {
//            $dm->persist($charter);
//            $dm->flush();
//
//            return $this->redirectToRoute('charter_show', array('id' => $id));
//        }
//
//        return $this->render('Charter/edit.html.twig', array(
//            'charter' => $charter,
//            'edit_form' => $editForm->createView(),
//        ));
//    }
//
//    private function createDeleteForm(string $id)
//    {
//
//        return $this->createFormBuilder()
//            ->setAction($this->generateUrl('charter_show', array('id' => $id)))
//            ->setMethod('DELETE')
//            ->getForm()
//            ;
//    }


}