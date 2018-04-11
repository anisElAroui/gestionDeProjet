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
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class ActionController extends Controller
{

    /**
     * @Route("/action", name="action_index")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        $actions = $this->get('doctrine_mongodb')->getRepository('App\Document\Action')->findAll();

        return $this->render('Action/index.html.twig', ['actions' => $actions,]);
    }


    /**
     * @Route("/action/new", name="action_new")
     * @Method({"POST","GET"})
     */
    public function newAction(Request $request)
    {
        $action = new Action();
        $form = $this->createForm('App\Form\ActionType', $action);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($action);
            $dm->flush();

            return $this->redirectToRoute('action_show', array('id' => $action->getId()));
        }

        return $this->render('Action/new.html.twig', array(
            'action' => $action,
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/action/{id}/show", name="action_show")
     * @Method({"GET","DELETE"})
     */
    public function showAction(Request $request, $id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $action = $dm->getRepository('App\Document\Action')->findOneBy(array('id' => $id));

        $deleteForm = $this->createDeleteForm($action,$id);

        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->remove($action);
            $dm->flush();

            return $this->redirectToRoute('action_index');
        }


        return $this->render('Action/show.html.twig', array(
            'action' => $action,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     *
     * @Route("/action/{id}/edit", name="action_edit")
     * @Method({"GET","POST"})
     */
    public function editAction(Request $request, $id)
    {

        $dm = $this->get('doctrine_mongodb')->getManager();
        $action = $dm->getRepository('App\Document\Action')->findOneBy(array('id' => $id));

        $editForm = $this->createForm('App\Form\Charter\ActionType', $action);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $dm->persist($action);
            $dm->flush();

            return $this->redirectToRoute('action_show', array('id' => $id));
        }

        return $this->render('Action/edit.html.twig', array(
            'action' => $action,
            'edit_form' => $editForm->createView(),
        ));
    }

    private function createDeleteForm(Action $action,string $id)
    {

        return $this->createFormBuilder()
            ->setAction($this->generateUrl('action_show', array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

}