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
     * @Route("/report", name="report_index")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        $reports = $this->get('doctrine_mongodb')->getRepository('App\Document\Report')->findAll();

        return $this->render('Report/index.html.twig', ['reports' => $reports,]);
    }


    /**
     * @Route("/report/new", name="report_new")
     * @Method({"POST","GET"})
     */
    public function newAction(Request $request)
    {
        $report = new Report();
        $form = $this->createForm('App\Form\ReportType', $report);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($report);
            $dm->flush();

            return $this->redirectToRoute('report_show', array('id' => $report->getId()));
        }

        return $this->render('Report/new.html.twig', array(
            'report' => $report,
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/report/{id}/show", name="report_show")
     * @Method({"GET","DELETE"})
     */
    public function showAction(Request $request, $id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $report = $dm->getRepository('App\Document\Report')->findOneBy(array('id' => $id));

        $deleteForm = $this->createDeleteForm($report,$id);

        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->remove($report);
            $dm->flush();

            return $this->redirectToRoute('report_index');
        }


        return $this->render('Report/show.html.twig', array(
            'report' => $report,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     *
     * @Route("/report/{id}/edit", name="report_edit")
     * @Method({"GET","POST"})
     */
    public function editAction(Request $request, $id)
    {

        $dm = $this->get('doctrine_mongodb')->getManager();
        $report = $dm->getRepository('App\Document\Report')->findOneBy(array('id' => $id));

        $editForm = $this->createForm('App\Form\ReportType', $report);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $dm->persist($report);
            $dm->flush();

            return $this->redirectToRoute('report_show', array('id' => $id));
        }

        return $this->render('Report/edit.html.twig', array(
            'report' => $report,
            'edit_form' => $editForm->createView(),
        ));
    }

    private function createDeleteForm(Report $report,string $id)
    {

        return $this->createFormBuilder()
            ->setAction($this->generateUrl('report_show', array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
    
}