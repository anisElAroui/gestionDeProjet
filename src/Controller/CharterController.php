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
use App\Document\Negociation;
use App\Document\User;
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

        $form = $this->createForm('App\Form\Charter\CharterType', $charter, array('validation_groups' => ['step'.$step]));
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $dm = $this->get('doctrine_mongodb')->getManager();

            // cette newAction ne s'effectue que par le PM
//            $user = $this->getUser();
//            $notification = $dm->getRepository("App\Document\Notification")->findOneBy(array('projectName' => $charter->getProjectName(),'receiver' => $user->getUsername(),'flag'=>true));
//            $notification->setFlag(false);
            $notification = $this->removeNotification($charter);

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
            if($step == 6){
//                $user = $this->getUser();
//                $notification = $dm->getRepository("App\Document\Notification")->findOneBy(array('projectName' => $charter->getProjectName(),'receiver' => $user->getUsername(),'flag'=>false));
//                $notification->setFlag(true);
//                $notification->setDescription("complete charter");
//                $notification->setCharterId($charter->getId());
//                $notification->setCreatedAt(new \DateTime());
//
//                // à modifier $user ici pour avoir le pmo
//                $notification->setReceiver($user);
                $receiver = $this->getUser(); // à changer selon le receiver= PMO
                $notification = $this->sendNotification($charter, "complete charter",$receiver,"Charter");
                $dm->persist($notification);
            }

            // enlever notification pour le PMO
            if($step == 7) {
                $notification = $this->removeNotification($charter);

                $dm->persist($notification);
            }

                $dm->persist($charter);
                $dm->flush();

            // lors du submit de la dernière étape ou plus
            if ($step >= 9){
                // on aura des notifs à envoyer que au PM lorsque le PMO change de budget
                // si le user a le role de PMO et non pas le role de PM ( à changer cdt à != ou selon le role )
                if ($this->getUser() == $charter->getProjectManager()) {
                    $receiver = $charter->getProjectManager(); // PM
                    $notification = $this->sendNotification($charter, "budget negociation", $receiver, "Negociation");

                    // envoyer notif au PM pour la negociation
//                $user = $this->getUser();
//                $notification = $dm->getRepository("App\Document\Notification")->findOneBy(array('projectName' => $charter->getProjectName(),'receiver' => $user->getUsername()));
//                $notification->setFlag(true);
//                $notification->setDescription("budget negociation");
//                $notification->setReceiver($charter->getProjectManager());
                    // le type est créer pour differencier lors du comptage des notif
//                $notification->setType("Negociation");
                    $dm->persist($notification);
                    $dm->flush();
                }

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
     * @Method({"GET"})
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
     * @Method({"GET"})
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
     * @Method({"GET"})
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
     * @Method({"GET"})
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
     * @Method({"GET","POST"})
     */
    public function showStep5Action(Request $request,$id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id);

        $negociation = $dm->getRepository("App\Document\Negociation")->findOneBy(array('charterId'=>$id));
//        if ($negociation == null){
//            $NegociationController = new NegociationController();
//            $NegociationController->newAction($request,$id);
//        }else{
//            $NegociationController = new NegociationController();
//            $NegociationController->editAction($request,$id);
//        }


//        $negociation = new Negociation();
//        $form = $this->createForm('App\Form\NegociationType', $negociation);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            // si PM a envoyé la negociation enlever notif et envoyer notif au PMO (les 2 avec un send)
//            if ($this->getUser() == $charter->getProjectManager()) {
//                $receiver = $this->getUser(); // changer le receiver par PMO
//                $notification = $this->sendNotification($charter, "budget decision", $receiver, "Negociation");
////                $negociation->setCharterId($charter->getId());
//            }
//
//            // si PMO a envoyé la decision enlever notif et envoyer notif au PM (les 2 avec un send)
//            if ($this->getUser() != $charter->getProjectManager()) {
//                $receiver = $this->getUser(); // changer le receiver par PM
//                // cdt si  project validated car budget edit se trouve dans editAction en boucle
//                $notification = $this->sendNotification($charter, "project validated", $receiver, "Charter");
//            }
//              // code de dessous fonctionne
//            $dm = $this->get('doctrine_mongodb')->getManager();
//            // enlever notif pour pm en changeant le user et envoyer notif au PMO
//            $user = $this->getUser();
//            $notification = $dm->getRepository("App\Document\Notification")->findOneBy(array('projectName' => $charter->getProjectName(), 'receiver' => $user->getUsername(), 'flag' => true));
//            // changer $user avec PMO sans mettre le flag à false
//            $notification->setReceiver($user);
//            $negociation->setCharterId($charter->getId());
//            // if user=PM submitted setDescription budget decision et enlever notif et envoyé au PMO
//            $notification->setDescription("budget decision");
//            // if user=PMO submitted donc setDescription validate et enlever notif et envoyé au PM(à faire)
//            $dm->persist($notification);
//            $dm->persist($negociation);
//            $dm->flush();
//            return $this->redirectToRoute('charter_show5', array('id' => $charter->getId()));
//        }

        return $this->render('Charter/show5.html.twig', array(
            'charter' => $charter,
            'negociation' => $negociation,
//            'form' => $form->createView(),

        ));
    }

    public function sendNotification(Charter $charter,String $description,User $receiver,String $type)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $user = $this->getUser();
        $notification = $dm->getRepository("App\Document\Notification")->findOneBy(array('projectName' => $charter->getProjectName(),'receiver' => $user->getUsername()));
        $notification->setFlag(true);
        $notification->setDescription($description);
        $notification->setCharterId($charter->getId());
        $notification->setCreatedAt(new \DateTime());
        $notification->setType($type);
        $notification->setReceiver($receiver);

        return $notification;
    }

    public function removeNotification(Charter $charter)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $user = $this->getUser();
        $notification = $dm->getRepository("App\Document\Notification")->findOneBy(array('projectName' => $charter->getProjectName(),'receiver' => $user->getUsername(),'flag'=>true));
        $notification->setFlag(false);

        return $notification;
    }

}