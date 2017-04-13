<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Inflow;
use HVG\SystemBundle\Form\InflowType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Inflow controller.
 *
 */
class InflowController extends Controller
{

    /**
     * Lists all Inflow entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $inflows = $em->getRepository('HVGSystemBundle:Inflow')->findBy(array(), array($sort => $direction));
        else $inflows = $em->getRepository('HVGSystemBundle:Inflow')->findAll();
        $paginator = $this->get('knp_paginator');
        $inflows = $paginator->paginate($inflows, $request->query->getInt('page', 1), 100);
        $inflow = new Inflow();
        $newForm = $this->createNewForm($inflow)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($inflows as $key => $inflow) {
            $editForms[] = $this->createEditForm($inflow)->createView();
            $deleteForms[] = $this->createDeleteForm($inflow)->createView();
        }

        return $this->render('inflow/index.html.twig', array(
            'inflows' => $inflows,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Inflow entity.
     *
     */
    public function newAction(Request $request)
    {
        $inflow = new Inflow();
        $newForm = $this->createNewForm($inflow);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($inflow);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'inflow.flash.created' );
            } else {
                return $this->render('inflow/new.html.twig', array(
                    'inflow' => $inflow,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('inflow_index'));
    }

    /**
     * Creates a form to create a new Inflow entity.
     *
     * @param Inflow $inflow The Inflow entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Inflow $inflow)
    {
        return $this->createForm('HVG\SystemBundle\Form\InflowType', $inflow, array(
            'action' => $this->generateUrl('inflow_new'),
        ));
    }

    /**
     * Finds and displays a Inflow entity.
     *
     */
    public function showAction(Inflow $inflow)
    {
        $editForm = $this->createEditForm($inflow);
        $deleteForm = $this->createDeleteForm($inflow);

        return $this->render('inflow/show.html.twig', array(
            'inflow' => $inflow,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Inflow entity.
     *
     */
    public function editAction(Request $request, Inflow $inflow)
    {
        $editForm = $this->createEditForm($inflow);
        $deleteForm = $this->createDeleteForm($inflow);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($inflow);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'inflow.flash.updated' );
            } else {
                return $this->render('inflow/edit.html.twig', array(
                    'inflow' => $inflow,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('inflow_index'));
    }

    /**
     * Creates a form to edit a Inflow entity.
     *
     * @param Inflow $inflow The Inflow entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Inflow $inflow)
    {
        return $this->createForm('HVG\SystemBundle\Form\InflowType', $inflow, array(
            'action' => $this->generateUrl('inflow_edit', array('id' => $inflow->getId())),
        ));
    }

    /**
     * Deletes a Inflow entity.
     *
     */
    public function deleteAction(Request $request, Inflow $inflow)
    {
        $deleteForm = $this->createDeleteForm($inflow);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($inflow);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'inflow.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('inflow_index'));
    }

    /**
     * Creates a form to delete a Inflow entity.
     *
     * @param Inflow $inflow The Inflow entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Inflow $inflow)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('inflow_delete', array('id' => $inflow->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
