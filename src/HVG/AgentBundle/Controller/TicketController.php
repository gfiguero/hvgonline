<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Ticket;
use HVG\SystemBundle\Entity\TicketAction;
use HVG\AgentBundle\Form\TicketType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TicketController extends Controller
{
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $tickets = $em->getRepository('HVGSystemBundle:Ticket')->findBy(array(), array($sort => $direction));
        else $tickets = $em->getRepository('HVGSystemBundle:Ticket')->findAll();
        $paginator = $this->get('knp_paginator');
        $tickets = $paginator->paginate($tickets, $request->query->getInt('page', 1), 100);

        return $this->render('HVGAgentBundle:Ticket:index.html.twig', array(
            'tickets' => $tickets,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function showAction(Ticket $ticket)
    {
        $ticketAction = new TicketAction();
        $ticketAction->setTicket($ticket);
        $newTicketActionForm = $this->container->get('form.factory')->create($this->get('hvg_agent.form.ticketaction'), $ticketAction, array(
            'action' => $this->generateUrl('agent_ticketaction_new'),
        ))->createView();
        $ticketStatusForm = $this->createTicketStatusForm($ticket)->createView();
        $editForm = $this->createEditForm($ticket)->createView();

        return $this->render('HVGAgentBundle:Ticket:show.html.twig', array(
            'ticket' => $ticket,
            'newTicketActionForm' => $newTicketActionForm,
            'ticketStatusForm' => $ticketStatusForm,
            'editForm' => $editForm,
        ));
    }

    public function newAction(Request $request)
    {
        $ticket = new Ticket();
        $newTicketForm = $this->container->get('form.factory')->create($this->get('hvg_agent.form.ticket'), $ticket, array(
            'action' => $this->generateUrl('agent_ticket_new'),
        ));
        $newTicketForm->handleRequest($request);

        if ($newTicketForm->isSubmitted()) {
            if($newTicketForm->isValid()) {
                $ticketAction = new TicketAction();
                $ticketAction->setTicket($ticket);
                $ticketAction->setDescription('Ticket Abierto');
                $ticketAction->setUser($this->get('security.token_storage')->getToken()->getUser());

                $em = $this->getDoctrine()->getManager();
                $ticket->setTicketStatus($em->getReference('HVGSystemBundle:TicketStatus', 1));
                $ticket->setUser($this->get('security.token_storage')->getToken()->getUser());
                $em->persist($ticket);
                $em->persist($ticketAction);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'ticket.flash.created' );
            }
        }

        return $this->redirect($request->headers->get('referer'));
    }

    public function statusAction(Request $request, Ticket $ticket)
    {
        $prevStatus = $ticket->getTicketStatus();
        $ticketStatusForm = $this->createTicketStatusForm($ticket);
        $ticketStatusForm->handleRequest($request);
        $postStatus = $ticket->getTicketStatus();

        if ($ticketStatusForm->isSubmitted()) {
            if($ticketStatusForm->isValid()) {
                $ticketAction = new TicketAction();
                $ticketAction->setTicket($ticket);
                $ticketAction->setDescription('El estado ha cambiado de ' . $prevStatus->getName() . ' a ' . $postStatus->getName() . '.');
                $ticketAction->setUser($this->get('security.token_storage')->getToken()->getUser());

                $em = $this->getDoctrine()->getManager();
                $em->persist($ticket);
                $em->persist($ticketAction);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'ticket.flash.editstatus' );
            }
        }

        return $this->redirect($request->headers->get('referer'));
    }

    public function editAction(Request $request, Ticket $ticket)
    {
        $editForm = $this->createEditForm($ticket);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $ticketAction = new TicketAction();
                $ticketAction->setTicket($ticket);
                $ticketAction->setDescription('El ticket ha sido editado.');
                $ticketAction->setUser($this->get('security.token_storage')->getToken()->getUser());

                $em = $this->getDoctrine()->getManager();
                $em->persist($ticket);
                $em->persist($ticketAction);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'ticket.flash.edit' );
            }
        }

        return $this->redirect($request->headers->get('referer'));
    }

    private function createTicketStatusForm(Ticket $ticket)
    {
        return $this->createForm('HVG\AgentBundle\Form\TicketStatusType', $ticket, array(
            'action' => $this->generateUrl('agent_ticket_status', array('id' => $ticket->getId())),
        ));
    }

    private function createEditForm(Ticket $ticket)
    {
        return $this->createForm('HVG\AgentBundle\Form\TicketType', $ticket, array(
            'action' => $this->generateUrl('agent_ticket_edit', array('id' => $ticket->getId())),
        ));
    }


}
