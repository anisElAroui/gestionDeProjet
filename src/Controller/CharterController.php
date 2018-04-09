<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 05/04/18
 * Time: 09:44
 */

namespace App\Controller;

use App\Document\Charter;
use App\Document\Requirement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\CharterType;
use App\Form\RequirementType;
use DateTime;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class CharterController extends Controller
{

//    /**
//     * @Route("/charter", name="charter_index")
//     * @Method({"GET"})
//     */
//    public function indexAction()
//    {
//        $charter = $this->get('doctrine_mongodb')->getRepository('App\Document\Charter')->findOneById("5ac7902f1ea6e35172195df5");
//        $requirements = $this->get('doctrine_mongodb')->getRepository('App\Document\Requirement')->findAll();
//        return $this->render('Charter/index.html.twig', array(
//            'charter' => $charter,
//            'requirements' => $requirements,
//        ));
//    }

    /**
     * @Route("/charter/new", name="charter_new")
     * @Method({"POST","GET"})
     */
    public function newAction(Request $request)
    {
        $charter = new Charter();
        $requirement = new Requirement();
        $charter->addRequirement($requirement);
        $form = $this->createForm('App\Form\CharterType', $charter);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($charter);
            $dm->flush();

            return $this->redirectToRoute('charter_show', array('id' => $charter->getId()));
        }

        return $this->render('Charter/new.html.twig', array(
            'charter' => $charter,
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/charter/{id}/show", name="charter_show")
     * @Method({"GET","DELETE"})
     */
    public function showAction($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $charter = $dm->getRepository('App\Document\Charter')->findOneBy(array('id' => $id));

        return $this->render('Charter/show.html.twig', array(
            'charter' => $charter,
        ));
    }

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