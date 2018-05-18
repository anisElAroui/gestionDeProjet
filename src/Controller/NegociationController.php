<?php

namespace App\Controller;
use App\Document\Charter\Charter;
use App\Document\Negociation;
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
     * @Route("/project/{id}/charter/show5/negoction/show", name="negociation_show")
     * @Method({"GET"})
     */
    public function showAction(Request $request,$id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $charter = $dm->getRepository("App\Document\Charter\Charter")->find($id);
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

            $dm->persist($notification);
            $dm->flush();
            return $this->redirectToRoute('charter_show', array('id' => $id));
        }
        return $this->render('Negociation/show.html.twig', array(
            'negociation' => $negociation,
            'charter'=>$charter,
            'form' => $form->createView()
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
                $dm->persist($notification);
                $dm->persist($negociation);
                $dm->flush();
            return $this->redirectToRoute('charter_show5', array('id' => $id));
        }
        return $this->render('Negociation/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function sendNotification(Charter $charter,String $description,$receiver,String $type)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $notification = $dm->getRepository("App\Document\Notification")->findOneBy(array('charterId'=>$charter->getId()));
        $notification->setFlag(true);
        $notification->setDescription($description);
        $notification->setCharterId($charter->getId());
        $notification->setCreatedAt(new \DateTime());
        $notification->setType($type);
        $notification->setReceiver($receiver);

        return $notification;
    }

}