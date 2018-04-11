<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 05/04/18
 * Time: 09:44
 */

namespace App\Controller;

use App\Document\Charter\Assumption;
use App\Document\Charter\Billing;
use App\Document\Charter\Charter;
use App\Document\Charter\Constraint;
use App\Document\Charter\Milestone;
use App\Document\Charter\Requirement;
use App\Document\Charter\Deliverables;
use App\Document\Charter\Stakeholder;
use App\Document\Charter\Budget;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\Charter\CharterType;
use App\Form\Charter\RequirementType;
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
        $deliverables = new Deliverables();
        $milestone = new Milestone();
        $constraint = new Constraint();
        $assumption = new Assumption();
        $stakeholder = new Stakeholder();
        $budget = new Budget();
        $billing = new Billing();

        $charter->addRequirement($requirement);
        $charter->addDeliverables($deliverables);
        $charter->addMilestones($milestone);
        $charter->addConstraints($constraint);
        $charter->addAssumptions($assumption);
        $charter->addStakeholders($stakeholder);
        $charter->addBudgets($budget);
        $charter->addBillings($billing);

        $form = $this->createForm('App\Form\Charter\CharterType', $charter);
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
        $charter = $dm->getRepository('App\Document\Charter\Charter')->findOneBy(array('id' => $id));

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