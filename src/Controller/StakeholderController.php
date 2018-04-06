<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 03/04/18
 * Time: 15:42
 */

namespace App\Controller;

use App\Document\Stakeholder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Document\Skateholder;
use App\Form\SkateholderType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class StakeholderController extends Controller
{
    /**
     * @Route("/stakeholder", name="stakeholder_index")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        $stakeholders = $this->get('doctrine_mongodb')->getRepository('App\Document\Stakeholder')->findAll();

        return $this->render('Stakeholder/index.html.twig', ['stakeholders' => $stakeholders,]);
    }


    /**
     * @Route("/stakeholder/new", name="stakeholder_new")
     * @Method({"POST","GET"})
     */
    public function newAction(Request $request)
    {
        $stakeholder = new Stakeholder();
        $form = $this->createForm('App\Form\StakeholderType', $stakeholder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($stakeholder);
            $dm->flush();

            return $this->redirectToRoute('stakeholder_show', array('id' => $stakeholder->getId()));
        }

        return $this->render('Stakeholder/new.html.twig', array(
            'stakeholder' => $stakeholder,
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/stakeholder/{id}/show", name="stakeholder_show")
     * @Method({"GET","DELETE"})
     */
    public function showAction(Request $request, $id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $stakeholder = $dm->getRepository('App\Document\Stakeholder')->findOneBy(array('id' => $id));

        $deleteForm = $this->createDeleteForm($stakeholder,$id);

        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->remove($stakeholder);
            $dm->flush();

            return $this->redirectToRoute('stakeholder_index');
        }


        return $this->render('Stakeholder/show.html.twig', array(
            'stakeholder' => $stakeholder,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     *
     * @Route("/stakeholder/{id}/edit", name="stakeholder_edit")
     * @Method({"GET","POST"})
     */
    public function editAction(Request $request, $id)
    {

        $dm = $this->get('doctrine_mongodb')->getManager();
        $stakeholder = $dm->getRepository('App\Document\Stakeholder')->findOneBy(array('id' => $id));

        $editForm = $this->createForm('App\Form\StakeholderType', $stakeholder);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $dm->persist($stakeholder);
            $dm->flush();

            return $this->redirectToRoute('stakeholder_show', array('id' => $id));
        }

        return $this->render('Stakeholder/edit.html.twig', array(
            'stakeholder' => $stakeholder,
            'edit_form' => $editForm->createView(),
        ));
    }

    private function createDeleteForm(Stakeholder $stakeholder,string $id)
    {

        return $this->createFormBuilder()
            ->setAction($this->generateUrl('stakeholder_show', array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

}