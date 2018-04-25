<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 20/04/18
 * Time: 09:58
 */

namespace App\Controller;
use App\Document\Log;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class LogController extends Controller
{

    /**
     * @Route("/log", name="log_index")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        $logs = $this->get('doctrine_mongodb')->getRepository('App\Document\Log')->findAll();

        return $this->render('Log/index.html.twig', ['logs' => $logs,]);
    }


    /**
     * @Route("/log/new", name="log_new")
     * @Method({"POST","GET"})
     */
    public function newAction(Request $request)
    {
        $log = new Log();
        $form = $this->createForm('App\Form\LogType', $log);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($log);
            $dm->flush();

            return $this->redirectToRoute('log_show', array('id' => $log->getId()));
        }

        return $this->render('Log/new.html.twig', array(
            'log' => $log,
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/log/{id}/show", name="log_show")
     * @Method({"GET","DELETE"})
     */
    public function showAction(Request $request, $id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $log = $dm->getRepository('App\Document\Log')->findOneBy(array('id' => $id));

        $deleteForm = $this->createDeleteForm($log,$id);

        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->remove($log);
            $dm->flush();

            return $this->redirectToRoute('log_index');
        }


        return $this->render('Log/show.html.twig', array(
            'log' => $log,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     *
     * @Route("/log/{id}/edit", name="log_edit")
     * @Method({"GET","POST"})
     */
    public function editAction(Request $request, $id)
    {

        $dm = $this->get('doctrine_mongodb')->getManager();
        $log = $dm->getRepository('App\Document\Log')->findOneBy(array('id' => $id));

        $editForm = $this->createForm('App\Form\LogType', $log);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $dm->persist($log);
            $dm->flush();

            return $this->redirectToRoute('log_show', array('id' => $id));
        }

        return $this->render('Log/edit.html.twig', array(
            'log' => $log,
            'edit_form' => $editForm->createView(),
        ));
    }

    private function createDeleteForm(Log $log,string $id)
    {

        return $this->createFormBuilder()
            ->setAction($this->generateUrl('log_show', array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }


}