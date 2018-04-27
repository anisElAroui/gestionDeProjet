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
use DateTime;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class CharterController extends Controller
{

//    /**
//     * @Route("/charter/{id}", name="charter_edit")
//     * @Route("/charter/new", name="charter_new")
//     * @Method({"POST","GET"})
//     */
//    public function newAction(Request $request,Charter $charter_id=null)
//    {
////        if(! $charter_id){
//            $charter = new Charter();
//            $requirement = new Requirement();
//            $deliverables = new Deliverables();
//            $milestone = new Milestone();
//            $constraint = new Constraint();
//            $assumption = new Assumption();
//            $stakeholder = new Stakeholder();
//            $budget = new Budget();
//            $billing = new Billing();
//
//            $charter->addRequirement($requirement);
//            $charter->addDeliverables($deliverables);
//            $charter->addMilestones($milestone);
//            $charter->addConstraints($constraint);
//            $charter->addAssumptions($assumption);
//            $charter->addStakeholders($stakeholder);
//            $charter->addBudgets($budget);
//            $charter->addBillings($billing);
//            $charter->setSteps(0);
//
////        }else{
//        $step = $charter->setSteps($charter->getSteps()+1);
////        }
//
//        $step=$charter->getSteps();
//
////        if( $charter_id){
////            $dm = $this->get('doctrine_mongodb')->getManager();
////            $charter = $dm->getRepository('App\Document\Charter\Charter')->findOneBy(array('id' => $charter_id));
////        }
//
//        $form = $this->createForm('App\Form\Charter\CharterType',$charter, array('validation_groups' => ['step'.$step]));
//        $form->handleRequest($request);
//
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $dm = $this->get('doctrine_mongodb')->getManager();
//            $dm->persist($charter);
//            $dm->flush();
////            return $this->redirectToRoute('charter_edit', array('id' => $charter->getId()));
//        }
//
//
//
//        return $this->render('Charter/new.html.twig', array(
//            'charter' => $charter,
//            'form' => $form->createView(),
//            'step'=>$step,
//
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
            $charter->setSteps(1);



            $step=$charter->getSteps();
            dump($step);

        $form = $this->createForm('App\Form\Charter\CharterType', $charter, array('validation_groups' => ['step'.$step]));
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($charter);
            $dm->flush();

            return $this->redirectToRoute('charter_edit', array('id' => $charter->getId()));
        }

        return $this->render('Charter/new.html.twig', array(
            'charter' => $charter,
            'form' => $form->createView(),
            'step'=>$step,
        ));
    }
    /**
     *
     * @Route("/charter/edit/{id}", name="charter_edit")
     * @Method({"GET","POST"})
     */
    public function editAction(Request $request, $id)
    {

        $dm = $this->get('doctrine_mongodb')->getManager();
        $charter = $dm->getRepository('App\Document\Charter\Charter')->findOneBy(array('id' => $id));

        $charter->setSteps($charter->getSteps()+1);

        $step=$charter->getSteps();

        $form = $this->createForm('App\Form\Charter\CharterType', $charter, array('validation_groups' => ['step'.$step]));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            $steackHolders=$form->getData('stakeholders');
//
//            foreach ($steackHolders as $steackHolder){
//                $stak=new Stakeholder();
//                $stak->setEmail($steackHolder['email']);
//                $stak->setName($steackHolder['name']);
//                $stak->setPhoneNumber($steackHolder['phoneNumber']);
//                $stak->setRole($steackHolder['role']);
//                $dm->persist($stak);
//                $dm->flush();
//                $charter->addStakeholders($stak);
//            }

            $dm->persist($charter);
            $dm->flush();

            // lors du submit de la dernière étape
            if ($step == 9){
                return $this->redirectToRoute('charter_show', array('id' => $id));
            }
            return $this->redirectToRoute('charter_edit', array('id' => $id));
        }

        return $this->render('Charter/new.html.twig', array(
            'charter' => $charter,
            'form' => $form->createView(),
            'step'=>$step,
        ));
    }

    /**
     * @Route("/project/{id}/charter/show", name="charter_show")
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