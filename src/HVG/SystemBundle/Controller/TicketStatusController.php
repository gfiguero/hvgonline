<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\TicketStatus;
use HVG\SystemBundle\Form\TicketStatusType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Ticketstatus controller.
 *
 */
class TicketStatusController extends Controller
{

    /**
     * Lists all TicketStatus entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $ticketStatuses = $em->getRepository('HVGSystemBundle:TicketStatus')->findBy(array(), array($sort => $direction));
        else $ticketStatuses = $em->getRepository('HVGSystemBundle:TicketStatus')->findAll();
        $paginator = $this->get('knp_paginator');
        $ticketStatuses = $paginator->paginate($ticketStatuses, $request->query->getInt('page', 1), 100);
        $ticketStatus = new TicketStatus();
        $newForm = $this->createNewForm($ticketStatus)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($ticketStatuses as $key => $ticketStatus) {
            $editForms[] = $this->createEditForm($ticketStatus)->createView();
            $deleteForms[] = $this->createDeleteForm($ticketStatus)->createView();
        }

        return $this->render('ticketstatus/index.html.twig', array(
            'ticketStatuses' => $ticketStatuses,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new TicketStatus entity.
     *
     */
    public function newAction(Request $request)
    {
        $ticketStatus = new TicketStatus();
        $newForm = $this->createNewForm($ticketStatus);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ticketStatus);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'ticketStatus.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new TicketStatus entity.
     *
     * @param TicketStatus $ticketStatus The TicketStatus entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(TicketStatus $ticketStatus)
    {
        return $this->createForm('HVG\SystemBundle\Form\TicketStatusType', $ticketStatus, array(
            'action' => $this->generateUrl('ticketstatus_new'),
        ));
    }

    /**
     * Finds and displays a TicketStatus entity.
     *
     */
    public function showAction(TicketStatus $ticketStatus)
    {
        $editForm = $this->createEditForm($ticketStatus);
        $deleteForm = $this->createDeleteForm($ticketStatus);

        return $this->render('ticketstatus/show.html.twig', array(
            'ticketStatus' => $ticketStatus,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TicketStatus entity.
     *
     */
    public function editAction(Request $request, TicketStatus $ticketStatus)
    {
        $editForm = $this->createEditForm($ticketStatus);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ticketStatus);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'ticketStatus.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a TicketStatus entity.
     *
     * @param TicketStatus $ticketStatus The TicketStatus entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(TicketStatus $ticketStatus)
    {
        return $this->createForm('HVG\SystemBundle\Form\TicketStatusType', $ticketStatus, array(
            'action' => $this->generateUrl('ticketstatus_edit', array('id' => $ticketStatus->getId())),
        ));
    }

    /**
     * Deletes a TicketStatus entity.
     *
     */
    public function deleteAction(Request $request, TicketStatus $ticketStatus)
    {
        $deleteForm = $this->createDeleteForm($ticketStatus);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ticketStatus);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'ticketStatus.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a TicketStatus entity.
     *
     * @param TicketStatus $ticketStatus The TicketStatus entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TicketStatus $ticketStatus)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ticketstatus_delete', array('id' => $ticketStatus->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
