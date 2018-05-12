<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 27/03/18
 * Time: 10:57
 */

namespace App\Controller;

use App\Document\Charter\Assumption;
use App\Document\Charter\Billing;
use App\Document\Charter\Budget;
use App\Document\Charter\Charter;
use App\Document\Charter\Constraint;
use App\Document\Charter\Deliverables;
use App\Document\Charter\Milestone;
use App\Document\Charter\Requirement;
use App\Document\Charter\Stakeholder;
use App\Document\Notification;
use App\Document\Project;
use App\Document\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ProjectController extends Controller
{

    /**
     * @Route("/project/add", name="add_new_project")
     * @Method({"POST","GET"})
     */
    public function addAction(Request $request)
    {
        $project = new Project();
        $form = $this->createForm('App\Form\ProjectType', $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dm = $this->get('doctrine_mongodb')->getManager();

            $charter=$this->createCharter($project);
            $dm->persist($charter);

            $receiver = $project->getProjectManager();
            $notification = $this->sendNotification($project,$charter, "prepare charter",$receiver,"Charter");

            $project->setCharterId($charter);
            $dm->persist($project);
            $charter->setProjectId($project);
            $dm->persist($charter);
            $dm->persist($notification);
            $dm->flush();

            return $this->redirectToRoute('project_index', array('id' => $project->getId()));
        }
        return $this->render('Project/new.html.twig', array(
            'project' => $project,
            'form' => $form->createView(),
        ));
    }

    public function createCharter(Project $project)
    {
        $charter = new Charter();
        $charter->setProjectName($project->getProjectName());
        $charter->setProjectDescription($project->getDescription());
        $charter->setProjectManager($project->getProjectManager());
        $charter->setSteps(0);
        return $charter;
    }

    public function sendNotification(Project $project,Charter $charter,String $description,User $receiver,String $type)
    {
        $notification = new Notification();
        $notification->setReceiver($project->getProjectManager());
        $notification->setProjectName($project->getProjectName());
        $notification->setDescription($description);
        $notification->setFlag(true);
        $notification->setType("Charter");
        $date = new \DateTime();
        $notification->setCreatedAt($date);
        $notification->setReceiver($receiver);
        $notification->setCharterId($charter->getId());

        return $notification;
    }
}