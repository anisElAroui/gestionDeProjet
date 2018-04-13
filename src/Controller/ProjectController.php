<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 27/03/18
 * Time: 10:57
 */

namespace App\Controller;

use App\Document\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Document\Accueil;
use App\Form\AccueilType;
use DateTime;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;




class ProjectController extends Controller
{


    /**
     * @Route("/project", name="project_index")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        $charters = $this->get('doctrine_mongodb')->getRepository('App\Document\Charter\Charter')->findAll();

        return $this->render('Accueil/index.html.twig', ['charters' => $charters,]);
    }

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
            $dm->persist($project);
            $dm->flush();

            return $this->redirectToRoute('project_index', array('id' => $project->getId()));
        }
        return $this->render('Project/new.html.twig', array(
            'project' => $project,
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/project/{id}/show", name="project_show")
     * @Method({"GET","DELETE"})
     */
    public function showAction(Request $request, $id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $charter = $dm->getRepository('App\Document\Charter\Charter')->findOneBy(array('id' => $id));

        $deleteForm = $this->createDeleteForm($id);

        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->remove($charter);
            $dm->flush();

            return $this->redirectToRoute('project_index');
        }


        return $this->render('Accueil/show.html.twig', array(
            'charter' => $charter,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     *
     * @Route("/project/{id}/edit", name="project_edit")
     * @Method({"GET","POST"})
     */
    public function editAction(Request $request, $id)
    {

        $dm = $this->get('doctrine_mongodb')->getManager();
        $charter = $dm->getRepository('App\Document\Charter\Charter')->findOneBy(array('id' => $id));

        $editForm = $this->createForm('App\Form\AccueilType', $charter);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $dm->persist($charter);
            $dm->flush();

            return $this->redirectToRoute('project_show', array('id' => $id));
        }

        return $this->render('Accueil/edit.html.twig', array(
            'charter' => $charter,
            'edit_form' => $editForm->createView(),
        ));
    }


    private function createDeleteForm(string $id)
    {

        return $this->createFormBuilder()
            ->setAction($this->generateUrl('project_show', array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

}