<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 02/05/18
 * Time: 10:03
 */

namespace App\Controller;
use App\Document\Opportunity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class OpportunityController extends Controller
{
    /**
     * @Route("project/{id}/opportunities", name="opportunities_index")
     * @Method({"GET"})
     */
    public function indexAction($id)
    {
        $opportunities = $this->get('doctrine_mongodb')->getRepository('App\Document\Opportunity')->findAll();

        $dm = $this->get('doctrine_mongodb')->getManager();
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id);

        return $this->render('Opportunity/index.html.twig', ['opportunities' => $opportunities,'charter' => $charter,]);
    }


    /**
     * @Route("project/{id}/opportunities/new", name="opportunities_new")
     * @Method({"POST","GET"})
     */
    public function newAction(Request $request,$id)
    {
        $opportunity = new Opportunity();
        $form = $this->createForm('App\Form\RiskOpportunityType', $opportunity);
        $form->handleRequest($request);

        $dm = $this->get('doctrine_mongodb')->getManager();
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id);

        if ($form->isSubmitted() && $form->isValid()) {
            $opportunity->setCharter($charter);
            $dm->persist($opportunity);
            $dm->flush();

            return $this->redirectToRoute('opportunities_show', array('id1' => $id,'id2' => $opportunity->getId()));
        }

        return $this->render('Opportunity/new.html.twig', array(
            'opportunity' => $opportunity,
            'charter' => $charter,
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("project/{id1}/opportunities/{id2}/show", name="opportunities_show")
     * @Method({"GET","DELETE"})
     */
    public function showAction(Request $request, $id1, $id2)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $opportunity = $dm->getRepository('App\Document\Opportunity')->find($id2);
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id1);

        $deleteForm = $this->createDeleteForm($id1,$id2);

        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $dm->remove($opportunity);
            $dm->flush();

            return $this->redirectToRoute('opportunities_index',array('id'=>$id1));
        }


        return $this->render('Opportunity/show.html.twig', array(
            'opportunity' => $opportunity,
            'charter' => $charter,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     *
     * @Route("project/{id1}/opportunities/{id2}/edit", name="opportunities_edit")
     * @Method({"GET","POST"})
     */
    public function editAction(Request $request,$id1,$id2)
    {

        $dm = $this->get('doctrine_mongodb')->getManager();
        $opportunity = $dm->getRepository('App\Document\Opportunity')->find($id2);
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find( $id1);

        $editForm = $this->createForm('App\Form\RiskOpportunityType', $opportunity);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $dm->persist($opportunity);
            $dm->flush();

            return $this->redirectToRoute('opportunities_show', array('id1'=>$id1,'id2' => $id2));
        }

        return $this->render('Opportunity/edit.html.twig', array(
            'opportunity' => $opportunity,
            'charter' => $charter,
            'edit_form' => $editForm->createView(),
        ));
    }

    private function createDeleteForm($id1,$id2)
    {

        return $this->createFormBuilder()
            ->setAction($this->generateUrl('opportunities_show', array('id1' => $id1,'id2' => $id2)))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

}