<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 10/05/18
 * Time: 11:08
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{

    /**
     * @Route("/project", name="project_index")
     * @Method({"GET"})
     */
    public function indexAction(Request $request)
    {
        $charters = $this->get('doctrine_mongodb')->getRepository('App\Document\Charter\Charter')->findAll();
        return $this->render('Accueil/index.html.twig', ['charters' => $charters,]);
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
        $project = $dm->getRepository('App\Document\Project')->findOneBy(array('charterId' => $charter));
        $editForm = $this->createForm('App\Form\HomeType', $project);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $dm->persist($project);
            $dm->flush();

            return $this->redirectToRoute('project_show', array('id' => $id));
        }

        return $this->render('Accueil/edit.html.twig', array(
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