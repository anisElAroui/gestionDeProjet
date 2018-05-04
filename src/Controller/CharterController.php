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
//            dump($step);

        $form = $this->createForm('App\Form\Charter\CharterType', $charter, array('validation_groups' => ['step'.$step]));
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $dm = $this->get('doctrine_mongodb')->getManager();

            // enlever notification en rendant flag = false
            $user = $this->getUser();
            $notification = $dm->getRepository("App\Document\Notification")->findOneBy(array('projectName' => $charter->getProjectName(),'receiver' => $user->getUsername(),'flag'=>true));
            $notification->setFlag(false);

            $dm->persist($charter);
            $dm->persist($notification);
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
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id);

        $charter->setSteps($charter->getSteps()+1);

        $step=$charter->getSteps();

        $form = $this->createForm('App\Form\Charter\CharterType', $charter, array('validation_groups' => ['step'.$step]));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // envoyer notification au PMO
//            if($step == 6){
//                $user = $this->getUser(); // à modifier
//                $notification = $dm->getRepository("App\Document\Notification")->findOneBy(array('projectName' => $charter->getProjectName(),'receiver' => $user->getUsername(),'flag'=>true));
//                $notification->setFlag(true);
//            }

            $dm->persist($charter);
            $dm->flush();

            // lors du submit de la dernière étape
            if ($step == 9){
                return $this->redirectToRoute('charter_show', array('id' => $id));
            }

            // lors des autres submit
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
    public function showStep1Action($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $charter = $dm->getRepository('App\Document\Charter\Charter')->findOneBy(array('id' => $id));

        return $this->render('Charter/show.html.twig', array(
            'charter' => $charter,
        ));
    }

    /**
     * @Route("/project/{id}/charter/show2", name="charter_show2")
     * @Method({"GET","DELETE"})
     */
    public function showStep2Action($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $charter = $dm->getRepository('App\Document\Charter\Charter')->findOneBy(array('id' => $id));

        return $this->render('Charter/show2.html.twig', array(
            'charter' => $charter,
        ));
    }

    /**
     * @Route("/project/{id}/charter/show3", name="charter_show3")
     * @Method({"GET","DELETE"})
     */
    public function showStep3Action($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $charter = $dm->getRepository('App\Document\Charter\Charter')->findOneBy(array('id' => $id));

        return $this->render('Charter/show3.html.twig', array(
            'charter' => $charter,
        ));
    }

    /**
     * @Route("/project/{id}/charter/show4", name="charter_show4")
     * @Method({"GET","DELETE"})
     */
    public function showStep4Action($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $charter = $dm->getRepository('App\Document\Charter\Charter')->findOneBy(array('id' => $id));

        return $this->render('Charter/show4.html.twig', array(
            'charter' => $charter,
        ));
    }

    /**
     * @Route("/project/{id}/charter/show5", name="charter_show5")
     * @Method({"GET","DELETE"})
     */
    public function showStep5Action($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $charter = $dm->getRepository('App\Document\Charter\Charter')->findOneBy(array('id' => $id));

        return $this->render('Charter/show5.html.twig', array(
            'charter' => $charter,
        ));
    }

}