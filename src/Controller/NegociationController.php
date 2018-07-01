<?php

namespace App\Controller;
use App\Document\Charter\Charter;
use App\Document\Negociation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class NegociationController extends Controller
{

    /**
     * @Route("/project/{id}/charter/show5/negociation", name="negociation")
     * @Method({"GET","POST"})
     */
    public function newAction(Request $request,$id)
    {
        $negociation = new Negociation();
        $form = $this->createForm('App\Form\NegociationType', $negociation,array(
            'action' => $this->generateUrl('negociation',['id'=>$id]),
            'method' => 'GET',
        ));
        $form->handleRequest($request);
        $dm = $this->get('doctrine_mongodb')->getManager();
        $charter = $dm->getRepository("App\Document\Charter\Charter")->find($id);

        if ($form->isSubmitted() && $form->isValid()) {
            // envoyer au PMO la décision du PM
            $receiver = "karimBorni"; // changer le receiver par PMO
            $notification = $this->sendNotification($charter, "budget decision", $receiver, "Negociation");

            $this->sendDecision($charter);
            $negociation->setCharterId($charter);
            $dm->persist($notification);
            $dm->persist($negociation);
            $dm->flush();
            return $this->redirectToRoute('charter_show5', array('id' => $id));
        }

        return $this->render('Negociation/new.html.twig', array(
            'form' => $form->createView(),
            'negociation' => $negociation,
            'charter'=>$charter
        ));
    }

    /**
     * @Route("/project/{id}/charter/show5/edit", name="negociation_edit")
     * @Method({"GET","POST"})
     */
    public function editAction(Request $request,$id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $charter = $dm->getRepository("App\Document\Charter\Charter")->find($id);

        $negociation = $dm->getRepository("App\Document\Negociation")->findOneBy(array('charterId'=>$charter));
        $form = $this->createForm('App\Form\NegociationType', $negociation,array(
            'action' => $this->generateUrl('negociation_edit',['id'=>$id]),
            'method' => 'GET',
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $receiver = "karimBorni"; // changer le receiver par PMO
            $notification = $this->sendNotification($charter, "budget decision", $receiver, "Negociation");
            $this->sendDecision($charter);
            $dm->persist($notification);
            $dm->persist($negociation);
            $dm->flush();
            return $this->redirectToRoute('charter_show5', array('id' => $id));
        }
        return $this->render('Negociation/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/project/{id}/charter/show5/negoction/show", name="negociation_show")
     * @IsGranted({"ROLE_ADMIN"})
     * @Method({"GET"})
     */
    public function showAction(Request $request,$id,\Swift_Mailer $mailer)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $charter = $dm->getRepository("App\Document\Charter\Charter")->find($id);
        $project = $dm->getRepository("App\Document\Project")->findOneBy(array('charterId'=>$id));
        $negociation = $dm->getRepository("App\Document\Negociation")->findOneBy(array('charterId'=>$charter));
        $form = $this->createForm('App\Form\NegociationType', $negociation,array(
            'action' => $this->generateUrl('negociation_show',['id'=>$id]),
            'method' => 'GET',
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // si PMO a valider le projet
            $receiver = $charter->getProjectManager(); // PM
            $notification = $this->sendNotification($charter, "project validated", $receiver, "Charter");
            $project->setValidated('true');
            $mailer=$this->get('app.mailer');
            // send to poleManager
//            $mailer->sendValidation('project validated','proxym.gestion.projet@gmail.com','anisBenAbdallah@gmail.com',$charter);
            //send to PM
//            $mailer->sendValidation('project validated','proxym.gestion.projet@gmail.com',$receiver,$charter);
            $mailer->sendValidation('project validated','proxym.gestion.projet@gmail.com','anis.el.aroui@gmail.com',$charter);


            $dm->persist($notification);
            $dm->persist($project);
            $dm->flush();
            return $this->redirectToRoute('charter_show', array('id' => $id));
        }
        return $this->render('Negociation/show.html.twig', array(
            'negociation' => $negociation,
            'charter'=>$charter,
            'form' => $form->createView()
        ));
    }

    public function sendNotification(Charter $charter,String $description,$receiver,String $type)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $notification = $dm->getRepository("App\Document\Notification")->findOneBy(array('charterId'=>$charter->getId()));
        $notification->setDescription($description);
        $notification->setCharterId($charter->getId());
        $notification->setCreatedAt(new \DateTime());
        $notification->setType($type);
        $notification->setReceiver($receiver);

        return $notification;
    }

    public function sendDecision(Charter $charter){
        $mailer=$this->get('app.mailer');
        $mailer->sendDecision('budget decision','proxym.gestion.projet@gmail.com','anis.el.aroui@gmail.com',$charter);
    }

}