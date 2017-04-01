<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\FundOutflow;
use HVG\SystemBundle\Form\FundOutflowType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Fundoutflow controller.
 *
 */
class FundOutflowController extends Controller
{

    /**
     * Lists all FundOutflow entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $fundOutflows = $em->getRepository('HVGSystemBundle:FundOutflow')->findBy(array(), array($sort => $direction));
        else $fundOutflows = $em->getRepository('HVGSystemBundle:FundOutflow')->findAll();
        $paginator = $this->get('knp_paginator');
        $fundOutflows = $paginator->paginate($fundOutflows, $request->query->getInt('page', 1), 30);
        $fundOutflow = new FundOutflow();
        $newForm = $this->createNewForm($fundOutflow)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($fundOutflows as $key => $fundOutflow) {
            $editForms[] = $this->createEditForm($fundOutflow)->createView();
            $deleteForms[] = $this->createDeleteForm($fundOutflow)->createView();
        }

        return $this->render('fundoutflow/index.html.twig', array(
            'fundOutflows' => $fundOutflows,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new FundOutflow entity.
     *
     */
    public function newAction(Request $request)
    {
        $fundOutflow = new FundOutflow();
        $newForm = $this->createNewForm($fundOutflow);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fundOutflow);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'fundOutflow.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new FundOutflow entity.
     *
     * @param FundOutflow $fundOutflow The FundOutflow entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(FundOutflow $fundOutflow)
    {
        return $this->createForm('HVG\SystemBundle\Form\FundOutflowType', $fundOutflow, array(
            'action' => $this->generateUrl('fundoutflow_new'),
        ));
    }

    /**
     * Finds and displays a FundOutflow entity.
     *
     */
    public function showAction(FundOutflow $fundOutflow)
    {
        $editForm = $this->createEditForm($fundOutflow);
        $deleteForm = $this->createDeleteForm($fundOutflow);

        return $this->render('fundoutflow/show.html.twig', array(
            'fundOutflow' => $fundOutflow,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing FundOutflow entity.
     *
     */
    public function editAction(Request $request, FundOutflow $fundOutflow)
    {
        $editForm = $this->createEditForm($fundOutflow);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fundOutflow);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'fundOutflow.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a FundOutflow entity.
     *
     * @param FundOutflow $fundOutflow The FundOutflow entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(FundOutflow $fundOutflow)
    {
        return $this->createForm('HVG\SystemBundle\Form\FundOutflowType', $fundOutflow, array(
            'action' => $this->generateUrl('fundoutflow_edit', array('id' => $fundOutflow->getId())),
        ));
    }

    /**
     * Deletes a FundOutflow entity.
     *
     */
    public function deleteAction(Request $request, FundOutflow $fundOutflow)
    {
        $deleteForm = $this->createDeleteForm($fundOutflow);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fundOutflow);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'fundOutflow.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a FundOutflow entity.
     *
     * @param FundOutflow $fundOutflow The FundOutflow entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FundOutflow $fundOutflow)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fundoutflow_delete', array('id' => $fundOutflow->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
