<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 04/04/18
 * Time: 09:18
 */

namespace App\Controller;

use App\Document\Finance;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class FinanceController extends Controller
{
    /**
     * @Route("/finance", name="finance_index")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        $finances = $this->get('doctrine_mongodb')->getRepository('App\Document\Finance')->findAll();

        return $this->render('Finance/index.html.twig', ['finances' => $finances,]);
    }


    /**
     * @Route("/finance/new", name="finance_new")
     * @Method({"POST","GET"})
     */
    public function newAction(Request $request)
    {
        $finance = new Finance();
        $form = $this->createForm('App\Form\FinanceType', $finance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($finance);
            $dm->flush();

            return $this->redirectToRoute('finance_show', array('id' => $finance->getId()));
        }

        return $this->render('Finance/new.html.twig', array(
            'finance' => $finance,
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/finance/{id}/show", name="finance_show")
     * @Method({"GET","DELETE"})
     */
    public function showAction(Request $request, $id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $finance = $dm->getRepository('App\Document\Finance')->findOneBy(array('id' => $id));

        $deleteForm = $this->createDeleteForm($id);

        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->remove($finance);
            $dm->flush();

            return $this->redirectToRoute('finance_index');
        }


        return $this->render('Finance/show.html.twig', array(
            'finance' => $finance,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     *
     * @Route("/finance/{id}/edit", name="finance_edit")
     * @Method({"GET","POST"})
     */
    public function editAction(Request $request, $id)
    {

        $dm = $this->get('doctrine_mongodb')->getManager();
        $finance = $dm->getRepository('App\Document\Finance')->findOneBy(array('id' => $id));

        $editForm = $this->createForm('App\Form\FinanceType', $finance);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $dm->persist($finance);
            $dm->flush();

            return $this->redirectToRoute('finance_show', array('id' => $id));
        }

        return $this->render('Finance/edit.html.twig', array(
            'finance' => $finance,
            'edit_form' => $editForm->createView(),
        ));
    }
    
    private function createDeleteForm(string $id)
    {

        return $this->createFormBuilder()
            ->setAction($this->generateUrl('finance_show', array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }


}