<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 04/04/18
 * Time: 09:18
 */

namespace App\Controller;

use App\Document\Finance;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class FinanceController extends Controller
{
    /**
     * @Route("project/{id}/finance", name="finance_index")
     * @Method({"GET"})
     */
    public function indexAction($id)
    {
        $finances = $this->get('doctrine_mongodb')->getRepository('App\Document\Finance')->findAll();

        $dm = $this->get('doctrine_mongodb')->getManager();
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id);

        return $this->render('Finance/index.html.twig', ['finances' => $finances,'charter' => $charter,]);
    }


    /**
     * @Route("project/{id}/finance/new", name="finance_new")
     * @Method({"POST","GET"})
     */
    public function newAction(Request $request, $id)
    {
        $finance = new Finance();
        $form = $this->createForm('App\Form\FinanceType', $finance);
        $form->handleRequest($request);

        $dm = $this->get('doctrine_mongodb')->getManager();
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id);


        if ($form->isSubmitted() && $form->isValid()) {
            $finance->setCharter($charter);
            $dm->persist($finance);
            $dm->flush();

            return $this->redirectToRoute('finance_show', array('id1' => $id,'id2' => $finance->getId()));
        }

        return $this->render('Finance/new.html.twig', array(
            'finance' => $finance,
            'charter' => $charter,
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("project/{id1}/finance/{id2}/show", name="finance_show")
     * @Method({"GET","DELETE"})
     */
    public function showAction(Request $request, $id1, $id2)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $finance = $dm->getRepository('App\Document\Finance')->find( $id2);
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id1);

        $deleteForm = $this->createDeleteForm($id1,$id2);

        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $dm->remove($finance);
            $dm->flush();

            return $this->redirectToRoute('finance_index',array('id'=>$id1));
        }


        return $this->render('Finance/show.html.twig', array(
            'finance' => $finance,
            'charter' => $charter,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     *
     * @Route("project/{id1}/finance/{id2}/edit", name="finance_edit")
     * @Method({"GET","POST"})
     */
    public function editAction(Request $request,$id1,$id2)
    {

        $dm = $this->get('doctrine_mongodb')->getManager();
        $finance = $dm->getRepository('App\Document\Finance')->find($id2);
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find( $id1);

        $editForm = $this->createForm('App\Form\FinanceType', $finance);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $dm->persist($finance);
            $dm->flush();

            return $this->redirectToRoute('finance_show', array('id1'=>$id1,'id2' => $id2));
        }

        return $this->render('Finance/edit.html.twig', array(
            'finance' => $finance,
            'charter' => $charter,
            'edit_form' => $editForm->createView(),
        ));
    }
    
    private function createDeleteForm($id1,$id2)
    {

        return $this->createFormBuilder()
            ->setAction($this->generateUrl('finance_show', array('id1' => $id1,'id2' => $id2)))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }


}