<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 20/04/18
 * Time: 11:11
 */

namespace App\Controller;
use App\Document\Report;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ReportController extends Controller
{

    /**
     * @Route("project/{id}/report", name="report_index")
     * @Method({"GET"})
     */
    public function indexAction($id)
    {

        $dm = $this->get('doctrine_mongodb')->getManager();
        $reports = $dm->getRepository('App\Document\Report')->findAll();
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id);

        return $this->render('Report/index.html.twig', ['reports' => $reports,'charter' => $charter]);
    }


    /**
     * @Route("project/{id}/report/new", name="report_new")
     * @Method({"POST","GET"})
     */
    public function newAction(Request $request,$id)
    {
        $report = new Report();
        $form = $this->createForm('App\Form\ReportType', $report);
        $form->handleRequest($request);

        $dm = $this->get('doctrine_mongodb')->getManager();
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id);

        if ($form->isSubmitted() && $form->isValid()) {
            $report->setCharter($charter);
            $dm->persist($report);
            $dm->flush();

            return $this->redirectToRoute('report_show', array('id1' => $id,'id2' => $report->getId()));
        }

        return $this->render('Report/new.html.twig', array(
            'report' => $report,
            'charter' => $charter,
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("project/{id1}/report/{id2}/show", name="report_show")
     * @Method({"GET","DELETE"})
     */
    public function showAction(Request $request, $id1,$id2)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $report = $dm->getRepository('App\Document\Report')->findOneBy(array('id' => $id2));
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id1);

        $deleteForm = $this->createDeleteForm($id1,$id2);

        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->remove($report);
            $dm->flush();

            return $this->redirectToRoute('report_index',array('id'=>$id1));
        }


        return $this->render('Report/show.html.twig', array(
            'report' => $report,
            'charter' => $charter,
            'delete_form' => $deleteForm->createView()
        ));
    }


    /**
     *
     * @Route("project/{id1}/report/{id2}/edit", name="report_edit")
     * @Method({"GET","POST"})
     */
    public function editAction(Request $request,$id1,$id2)
    {

        $dm = $this->get('doctrine_mongodb')->getManager();
        $report = $dm->getRepository('App\Document\Report')->findOneBy(array('id' => $id2));
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find( $id1);

        $editForm = $this->createForm('App\Form\ReportType', $report);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $dm->persist($report);
            $dm->flush();

            return $this->redirectToRoute('report_show', array('id1'=>$id1,'id2' => $id2));
        }

        return $this->render('Report/edit.html.twig', array(
            'report' => $report,
            'charter' => $charter,
            'edit_form' => $editForm->createView()
        ));
    }

    private function createDeleteForm( $id1, $id2)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('report_show', array('id1' => $id1,'id2' => $id2)))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
    
}