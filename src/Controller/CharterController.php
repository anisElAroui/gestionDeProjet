<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 05/04/18
 * Time: 09:44
 */

namespace App\Controller;
use App\Document\Charter\Charter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CharterController extends Controller
{

    /**
     *
     * @Route("/charter/edit/{id}", name="charter_edit")
     * @IsGranted({"ROLE_PM"})
     * @Method({"GET","POST"})
     */
    public function editAction(Request $request, $id)
    {

        $dm = $this->get('doctrine_mongodb')->getManager();
        $charter = $dm->getRepository('App\Document\Charter\Charter')->find($id);

        $charter->setSteps($charter->getSteps()+1);
        $step=$charter->getSteps();
        $form = $this->createForm('App\Form\Charter\CharterType', $charter, array('validation_groups' => ['step'.$step],'role' => $this->getUser()->getRoles()));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dm->persist($charter);
            $dm->flush();
            if($step == 6){
                $receiver = 'karimBorni'; // à changer selon le role receiver= PMO
                $notification = $this->sendNotification($charter, 'complete charter',$receiver,'Charter');
                $dm->persist($notification);
                $dm->flush();
                return $this->redirectToRoute('charter_show', array('id' => $id));
            }

//                $dm->persist($charter);
//                $dm->flush();

            // lors du submit de la dernière étape ou plus
            if ($step >= 9){
                // on aura des notifs à envoyer que au PM lorsque le PMO change de budget
                // si le user a le role de PMO et non pas le role de PM
                if ($this->getUser()->getUsername() == 'karimBorni') {
                    $receiver = $charter->getProjectManager(); // PM
                    $notification = $this->sendNotification($charter, 'budget negociation', $receiver, 'Negociation');
                    $dm->persist($notification);
                    // persiste project budget
                    $dm->persist($this->defineBudget($charter));
                    $dm->flush();
                }
                return $this->redirectToRoute('charter_show', array('id' => $id));
            }
            // lors des autres submit < 9
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
        return $this->render('Charter/show5.html.twig', array(
            'charter' => $charter,
            'negociation' => $negociation,
        ));
    }

    public function sendNotification(Charter $charter,String $description,$receiver,String $type)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $notification = $dm->getRepository("App\Document\Notification")->findOneBy(array('charterId'=>$charter->getId()));
        $notification->setFlag(true);
        $notification->setDescription($description);
        $notification->setCreatedAt(new \DateTime());
        $notification->setType($type);
        $notification->setReceiver($receiver);

        return $notification;
    }

    public function defineBudget(Charter $charter)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $project = $dm->getRepository("App\Document\Project")->findOneBy(array('charterId'=>$charter->getId()));
        $project->setBudget($charter->getPlannedExpensesBudget()+$charter->getAgreedWageExpenses());

        return $project;
    }

}