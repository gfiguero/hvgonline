<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Ticket;
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
        $ticketactions = $ticket->getTicketActions();

        return $this->render('HVGAgentBundle:Ticket:show.html.twig', array(
            'ticketactions' => $ticketactions,
            'ticket' => $ticket,
        ));
    }

    public function newAction(Request $request)
    {
        $ticket = new Ticket();
        $newTicketForm = $this->createNewTicketForm($ticket);
        $newTicketForm->handleRequest($request);

        if ($newTicketForm->isSubmitted()) {
            if($newTicketForm->isValid()) {
                $ticket->setTicketStatus($this->getDoctrine()->getManager()->getReference('HVGSystemBundle:TicketStatus', 1));
                $ticket->setUser($this->get('security.token_storage')->getToken()->getUser());
                $em = $this->getDoctrine()->getManager();
                $em->persist($ticket);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'ticket.flash.created' );
            }
        }

        return $this->redirect($request->headers->get('referer'));
    }

    private function createNewTicketForm(Ticket $ticket)
    {
        return $this->createForm('HVG\AgentBundle\Form\TicketType', $ticket, array(
//            'action' => $this->generateUrl('agent_unit_ticket_new', array( 'id' => $ticket->getUnit()->getId() )),
            'action' => $this->generateUrl('agent_ticket_new'),
        ));
    }

}
