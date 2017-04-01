<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\FundInflow;
use HVG\SystemBundle\Form\FundInflowType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Fundinflow controller.
 *
 */
class FundInflowController extends Controller
{

    /**
     * Lists all FundInflow entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $fundInflows = $em->getRepository('HVGSystemBundle:FundInflow')->findBy(array(), array($sort => $direction));
        else $fundInflows = $em->getRepository('HVGSystemBundle:FundInflow')->findAll();
        $paginator = $this->get('knp_paginator');
        $fundInflows = $paginator->paginate($fundInflows, $request->query->getInt('page', 1), 30);
        $fundInflow = new FundInflow();
        $newForm = $this->createNewForm($fundInflow)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($fundInflows as $key => $fundInflow) {
            $editForms[] = $this->createEditForm($fundInflow)->createView();
            $deleteForms[] = $this->createDeleteForm($fundInflow)->createView();
        }

        return $this->render('fundinflow/index.html.twig', array(
            'fundInflows' => $fundInflows,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new FundInflow entity.
     *
     */
    public function newAction(Request $request)
    {
        $fundInflow = new FundInflow();
        $newForm = $this->createNewForm($fundInflow);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fundInflow);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'fundInflow.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new FundInflow entity.
     *
     * @param FundInflow $fundInflow The FundInflow entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(FundInflow $fundInflow)
    {
        return $this->createForm('HVG\SystemBundle\Form\FundInflowType', $fundInflow, array(
            'action' => $this->generateUrl('fundinflow_new'),
        ));
    }

    /**
     * Finds and displays a FundInflow entity.
     *
     */
    public function showAction(FundInflow $fundInflow)
    {
        $editForm = $this->createEditForm($fundInflow);
        $deleteForm = $this->createDeleteForm($fundInflow);

        return $this->render('fundinflow/show.html.twig', array(
            'fundInflow' => $fundInflow,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing FundInflow entity.
     *
     */
    public function editAction(Request $request, FundInflow $fundInflow)
    {
        $editForm = $this->createEditForm($fundInflow);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fundInflow);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'fundInflow.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a FundInflow entity.
     *
     * @param FundInflow $fundInflow The FundInflow entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(FundInflow $fundInflow)
    {
        return $this->createForm('HVG\SystemBundle\Form\FundInflowType', $fundInflow, array(
            'action' => $this->generateUrl('fundinflow_edit', array('id' => $fundInflow->getId())),
        ));
    }

    /**
     * Deletes a FundInflow entity.
     *
     */
    public function deleteAction(Request $request, FundInflow $fundInflow)
    {
        $deleteForm = $this->createDeleteForm($fundInflow);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fundInflow);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'fundInflow.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a FundInflow entity.
     *
     * @param FundInflow $fundInflow The FundInflow entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FundInflow $fundInflow)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fundinflow_delete', array('id' => $fundInflow->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
