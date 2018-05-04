<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 03/04/18
 * Time: 15:42
 */

namespace App\Controller;

use App\Document\Charter\Stakeholder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class StakeholderController extends Controller
{

    /**
     * @Route("project/{id}/stakeholder", name="stakeholder_index")
     * @Method({"GET"})
     */
    public function indexAction($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id);

        return $this->render('Stakeholder/index.html.twig', ['charter' => $charter,]);
    }


    /**
     * @Route("project/{id}/stakeholder/new", name="stakeholder_new")
     * @Method({"POST","GET"})
     */
    public function newAction(Request $request, $id)
    {
        $stakeholder = new Stakeholder();

        $form = $this->createForm('App\Form\Charter\StakeholderType', $stakeholder);
        $form->handleRequest($request);

        $dm = $this->get('doctrine_mongodb')->getManager();
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id);

        if ($form->isSubmitted() && $form->isValid())
        {
            $charter->addStakeholders($stakeholder);
            $dm->persist($charter);
            $dm->flush();

            return $this->redirectToRoute('stakeholder_show', array('id1' => $id,'id2' => $stakeholder->getId()));
        }

        return $this->render('Stakeholder/new.html.twig', array(
            'form' => $form->createView(),
            'charter' => $charter,
        ));
    }


    /**
     *
     * @Route("project/{id1}/stakeholder/{id2}/edit", name="stakeholder_edit")
     * @Method({"GET","POST"})
     */
    public function editAction(Request $request, $id1, $id2)
    {

        $dm = $this->get('doctrine_mongodb')->getManager();

        $stakeholder = $dm->getRepository('App\Document\Charter\Stakeholder')->find($id2);
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id1);

        $editForm = $this->createForm('App\Form\Charter\StakeholderType',$stakeholder);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $dm->persist($stakeholder);
            $dm->flush();

            return $this->redirectToRoute('stakeholder_show', array('id1'=>$id1,'id2' => $id2));
        }

        return $this->render('Stakeholder/edit.html.twig', array(
            'edit_form' => $editForm->createView(),
            'charter'=>$charter,
        ));
    }

    /**
     * @Route("project/{id1}/stakeholder/{id2}/show", name="stakeholder_show")
     * @Method({"GET","DELETE"})
     */
    public function showAction(Request $request, $id1, $id2)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $stakeholder = $dm->getRepository('App\Document\Charter\Stakeholder')->find($id2);
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id1);

//        $deleteForm = $this->DeleteForm($id1,$id2);
//        $deleteForm->handleRequest($request);
//
//        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
//            $dm = $this->get('doctrine_mongodb')->getManager();
//            $dm->remove($stakeholder);
//            // remove l'id de stakeholder dans charter ?
//            $dm->flush();
//
//            return $this->redirectToRoute('stakeholder_index',array('id'=>$id1));
//        }

        return $this->render('Stakeholder/show.html.twig', array(
            'stakeholder'=> $stakeholder,
            'charter'=> $charter,
//            'delete_form' => $deleteForm->createView(),
        ));
    }

    //    private function DeleteForm(string $id1,string $id2)
//    {
//
//        return $this->createFormBuilder()
//            ->setAction($this->generateUrl('stakeholder_show', array('id1' => $id1,'id2' => $id2)))
//            ->setMethod('DELETE')
//            ->getForm()
//            ;
//    }

}