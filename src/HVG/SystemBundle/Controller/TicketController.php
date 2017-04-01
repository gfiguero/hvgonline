<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Ticket;
use HVG\SystemBundle\Form\TicketType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Ticket controller.
 *
 */
class TicketController extends Controller
{

    /**
     * Lists all Ticket entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $tickets = $em->getRepository('HVGSystemBundle:Ticket')->findBy(array(), array($sort => $direction));
        else $tickets = $em->getRepository('HVGSystemBundle:Ticket')->findAll();
        $paginator = $this->get('knp_paginator');
        $tickets = $paginator->paginate($tickets, $request->query->getInt('page', 1), 100);
        $ticket = new Ticket();
        $newForm = $this->createNewForm($ticket)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($tickets as $key => $ticket) {
            $editForms[] = $this->createEditForm($ticket)->createView();
            $deleteForms[] = $this->createDeleteForm($ticket)->createView();
        }

        return $this->render('ticket/index.html.twig', array(
            'tickets' => $tickets,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Ticket entity.
     *
     */
    public function newAction(Request $request)
    {
        $ticket = new Ticket();
        $newForm = $this->createNewForm($ticket);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ticket);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'ticket.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new Ticket entity.
     *
     * @param Ticket $ticket The Ticket entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Ticket $ticket)
    {
        return $this->createForm('HVG\SystemBundle\Form\TicketType', $ticket, array(
            'action' => $this->generateUrl('ticket_new'),
        ));
    }

    /**
     * Finds and displays a Ticket entity.
     *
     */
    public function showAction(Ticket $ticket)
    {
        $editForm = $this->createEditForm($ticket);
        $deleteForm = $this->createDeleteForm($ticket);

        return $this->render('ticket/show.html.twig', array(
            'ticket' => $ticket,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Ticket entity.
     *
     */
    public function editAction(Request $request, Ticket $ticket)
    {
        $editForm = $this->createEditForm($ticket);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ticket);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'ticket.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a Ticket entity.
     *
     * @param Ticket $ticket The Ticket entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Ticket $ticket)
    {
        return $this->createForm('HVG\SystemBundle\Form\TicketType', $ticket, array(
            'action' => $this->generateUrl('ticket_edit', array('id' => $ticket->getId())),
        ));
    }

    /**
     * Deletes a Ticket entity.
     *
     */
    public function deleteAction(Request $request, Ticket $ticket)
    {
        $deleteForm = $this->createDeleteForm($ticket);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ticket);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'ticket.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a Ticket entity.
     *
     * @param Ticket $ticket The Ticket entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ticket $ticket)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ticket_delete', array('id' => $ticket->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
