<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 02/05/18
 * Time: 10:07
 */

namespace App\Controller;
use App\Document\Risk;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class RiskController extends Controller
{
    /**
     * @Route("project/{id}/risks", name="risks_index")
     * @Method({"GET"})
     */
    public function indexAction($id)
    {
        $risks = $this->get('doctrine_mongodb')->getRepository('App\Document\Risk')->findAll();

        $dm = $this->get('doctrine_mongodb')->getManager();
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id);

        return $this->render('Risk/index.html.twig', ['risks' => $risks,'charter' => $charter,]);
    }


    /**
     * @Route("project/{id}/risks/new", name="risks_new")
     * @Method({"POST","GET"})
     */
    public function newAction(Request $request,$id)
    {
        $risk = new Risk();
        $form = $this->createForm('App\Form\RiskOpportunityType', $risk);
        $form->handleRequest($request);

        $dm = $this->get('doctrine_mongodb')->getManager();
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id);

        if ($form->isSubmitted() && $form->isValid()) {
            $risk->setCharter($charter);
            $dm->persist($risk);
            $dm->flush();

            return $this->redirectToRoute('risks_show', array('id1' => $id,'id2' => $risk->getId()));
        }

        return $this->render('Risk/new.html.twig', array(
            'risk' => $risk,
            'charter' => $charter,
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("project/{id1}/risks/{id2}/show", name="risks_show")
     * @Method({"GET","DELETE"})
     */
    public function showAction(Request $request, $id1, $id2)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $risk = $dm->getRepository('App\Document\Risk')->find($id2);
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id1);

        $deleteForm = $this->createDeleteForm($id1,$id2);

        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $dm->remove($risk);
            $dm->flush();

            return $this->redirectToRoute('risks_index',array('id'=>$id1));
        }


        return $this->render('Risk/show.html.twig', array(
            'risk' => $risk,
            'charter' => $charter,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     *
     * @Route("project/{id1}/risks/{id2}/edit", name="risks_edit")
     * @Method({"GET","POST"})
     */
    public function editAction(Request $request,$id1,$id2)
    {

        $dm = $this->get('doctrine_mongodb')->getManager();
        $risk = $dm->getRepository('App\Document\Risk')->find($id2);
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find( $id1);

        $editForm = $this->createForm('App\Form\RiskOpportunityType', $risk);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $dm->persist($risk);
            $dm->flush();

            return $this->redirectToRoute('risks_show', array('id1'=>$id1,'id2' => $id2));
        }

        return $this->render('Risk/edit.html.twig', array(
            'risk' => $risk,
            'charter' => $charter,
            'edit_form' => $editForm->createView(),
        ));
    }

    private function createDeleteForm($id1,$id2)
    {

        return $this->createFormBuilder()
            ->setAction($this->generateUrl('risks_show', array('id1' => $id1,'id2' => $id2)))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

}