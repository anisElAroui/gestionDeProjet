<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 11/04/18
 * Time: 09:33
 */

namespace App\Controller;

use App\Document\Action;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ActionController extends Controller
{

    /**
     * @Route("project/{id}/action", name="action_index")
     * @Method({"GET"})
     */
    public function indexAction($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $actions = $dm->getRepository('App\Document\Action')->findAll();
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id);

        return $this->render('Action/index.html.twig', ['actions' => $actions,'charter' => $charter]);
    }


    /**
     * @Route("project/{id}/action/new", name="action_new")
     * @Method({"POST","GET"})
     */
    public function newAction(Request $request,$id)
    {
        $action = new Action();
        $form = $this->createForm('App\Form\ActionType', $action);
        $form->handleRequest($request);

        $dm = $this->get('doctrine_mongodb')->getManager();
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id);

        if ($form->isSubmitted() && $form->isValid()) {
            $action->setCharter($charter);
            $dm->persist($action);
            $dm->flush();

            return $this->redirectToRoute('action_show', array('id1' => $id,'id2' => $action->getId()));
        }

        return $this->render('Action/new.html.twig', array(
            'action' => $action,
            'charter' => $charter,
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("project/{id1}/action/{id2}/show", name="action_show")
     * @Method({"GET","DELETE"})
     */
    public function showAction(Request $request, $id1,$id2)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $action = $dm->getRepository('App\Document\Action')->find($id2);
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id1);

        $deleteForm = $this->createDeleteForm($id1,$id2);

        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $dm->remove($action);
            $dm->flush();

            return $this->redirectToRoute('action_index',array('id'=>$id1));
        }


        return $this->render('Action/show.html.twig', array(
            'action' => $action,
            'charter' => $charter,
            'delete_form' => $deleteForm->createView()
        ));
    }


    /**
     *
     * @Route("project/{id1}/action/{id2}/edit", name="action_edit")
     * @Method({"GET","POST"})
     */
    public function editAction(Request $request,$id1,$id2)
    {

        $dm = $this->get('doctrine_mongodb')->getManager();
        $action = $dm->getRepository('App\Document\Action')->find($id2);
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find( $id1);

        $editForm = $this->createForm('App\Form\ActionType', $action);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $dm->persist($action);
            $dm->flush();

            return $this->redirectToRoute('action_show', array('id1'=>$id1,'id2' => $id2));
        }

        return $this->render('Action/edit.html.twig', array(
            'action' => $action,
            'charter' => $charter,
            'edit_form' => $editForm->createView()
        ));
    }

    private function createDeleteForm($id1,$id2)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('action_show', array('id1' => $id1,'id2' => $id2)))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

}