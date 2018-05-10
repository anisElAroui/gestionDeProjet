<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 20/04/18
 * Time: 09:58
 */

namespace App\Controller;

use App\Document\Log;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class LogController extends Controller
{

    /**
     * @Route("project/{id}/log", name="log_index")
     * @Method({"GET"})
     */
    public function indexAction($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $logs = $dm->getRepository('App\Document\Log')->findAll();
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id);

        return $this->render('Log/index.html.twig', ['logs' => $logs,'charter' => $charter]);
    }


    /**
     * @Route("project/{id}/log/new", name="log_new")
     * @Method({"POST","GET"})
     */
    public function newAction(Request $request,$id)
    {
        $log = new Log();
        $form = $this->createForm('App\Form\LogType', $log);
        $form->handleRequest($request);

        $dm = $this->get('doctrine_mongodb')->getManager();
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id);

        if ($form->isSubmitted() && $form->isValid()) {
            $log->setCharter($charter);
            $dm->persist($log);
            $dm->flush();

            return $this->redirectToRoute('log_show', array('id1' => $id,'id2' => $log->getId()));
        }

        return $this->render('Log/new.html.twig', array(
            'log' => $log,
            'charter' => $charter,
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("project/{id1}/log/{id2}/show", name="log_show")
     * @Method({"GET","DELETE"})
     */
    public function showAction(Request $request, $id1, $id2)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $log = $dm->getRepository('App\Document\Log')->find($id2);
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id1);

        $deleteForm = $this->createDeleteForm($id1,$id2);

        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $dm->remove($log);
            $dm->flush();

            return $this->redirectToRoute('log_index',array('id'=>$id1));
        }


        return $this->render('Log/show.html.twig', array(
            'log' => $log,
            'charter' => $charter,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     *
     * @Route("project/{id1}/log/{id2}/edit", name="log_edit")
     * @Method({"GET","POST"})
     */
    public function editAction(Request $request,$id1,$id2)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $log = $dm->getRepository('App\Document\Log')->find($id2);
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find( $id1);

        $editForm = $this->createForm('App\Form\LogType', $log);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $dm->persist($log);
            $dm->flush();

            return $this->redirectToRoute('log_show', array('id1'=>$id1,'id2' => $id2));
        }

        return $this->render('Log/edit.html.twig', array(
            'log' => $log,
            'charter' => $charter,
            'edit_form' => $editForm->createView(),
        ));
    }

    private function createDeleteForm($id1,$id2)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('log_show', array('id1' => $id1,'id2' => $id2)))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

}