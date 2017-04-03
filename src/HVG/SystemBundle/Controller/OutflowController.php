<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Outflow;
use HVG\SystemBundle\Form\OutflowType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Outflow controller.
 *
 */
class OutflowController extends Controller
{

    /**
     * Lists all Outflow entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $outflows = $em->getRepository('HVGSystemBundle:Outflow')->findBy(array(), array($sort => $direction));
        else $outflows = $em->getRepository('HVGSystemBundle:Outflow')->findAll();
        $paginator = $this->get('knp_paginator');
        $outflows = $paginator->paginate($outflows, $request->query->getInt('page', 1), 100);
        $outflow = new Outflow();
        $newForm = $this->createNewForm($outflow)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($outflows as $key => $outflow) {
            $editForms[] = $this->createEditForm($outflow)->createView();
            $deleteForms[] = $this->createDeleteForm($outflow)->createView();
        }

        return $this->render('outflow/index.html.twig', array(
            'outflows' => $outflows,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Outflow entity.
     *
     */
    public function newAction(Request $request)
    {
        $outflow = new Outflow();
        $newForm = $this->createNewForm($outflow);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($outflow);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'outflow.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new Outflow entity.
     *
     * @param Outflow $outflow The Outflow entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Outflow $outflow)
    {
        return $this->createForm('HVG\SystemBundle\Form\OutflowType', $outflow, array(
            'action' => $this->generateUrl('outflow_new'),
        ));
    }

    /**
     * Finds and displays a Outflow entity.
     *
     */
    public function showAction(Outflow $outflow)
    {
        $editForm = $this->createEditForm($outflow);
        $deleteForm = $this->createDeleteForm($outflow);

        return $this->render('outflow/show.html.twig', array(
            'outflow' => $outflow,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Outflow entity.
     *
     */
    public function editAction(Request $request, Outflow $outflow)
    {
        $editForm = $this->createEditForm($outflow);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($outflow);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'outflow.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a Outflow entity.
     *
     * @param Outflow $outflow The Outflow entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Outflow $outflow)
    {
        return $this->createForm('HVG\SystemBundle\Form\OutflowType', $outflow, array(
            'action' => $this->generateUrl('outflow_edit', array('id' => $outflow->getId())),
        ));
    }

    /**
     * Deletes a Outflow entity.
     *
     */
    public function deleteAction(Request $request, Outflow $outflow)
    {
        $deleteForm = $this->createDeleteForm($outflow);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($outflow);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'outflow.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a Outflow entity.
     *
     * @param Outflow $outflow The Outflow entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Outflow $outflow)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('outflow_delete', array('id' => $outflow->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
