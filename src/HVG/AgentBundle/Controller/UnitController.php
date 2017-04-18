<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\Ticket;
use HVG\AgentBundle\Form\TicketType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UnitController extends Controller
{
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $units = $em->getRepository('HVGSystemBundle:Unit')->findBy(array(), array($sort => $direction));
        else $units = $em->getRepository('HVGSystemBundle:Unit')->findAll();
        $paginator = $this->get('knp_paginator');
        $units = $paginator->paginate($units, $request->query->getInt('page', 1), 100);

        return $this->render('HVGAgentBundle:Unit:index.html.twig', array(
            'units' => $units,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function showAction(Unit $unit)
    {
        $unitgroup = $unit->getUnitGroup();
        $community = $unitgroup->getCommunity();
        $tickets = $unit->getTickets();
        $allowances = $unit->getAllowances();
        $charges = $unit->getCharges();

        $ticket = new Ticket();
        $ticket->setUnit($unit);
        $newTicketForm = $this->createNewTicketForm($ticket)->createView();

        $user = $this->get('security.token_storage')->getToken()->getUser();
        dump($user);
        return $this->render('HVGAgentBundle:Unit:show.html.twig', array(
            'unit' => $unit,
            'unitgroup' => $unitgroup,
            'community' => $community,
            'tickets' => $tickets,
            'allowances' => $allowances,
            'charges' => $charges,
            'newTicketForm' => $newTicketForm,
        ));
    }

    public function newTicketAction(Request $request, Unit $unit)
    {
        $ticket = new Ticket();
        $ticket->setUnit($unit);
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
            'action' => $this->generateUrl('agent_unit_ticket_new', array( 'id' => $ticket->getUnit()->getId() )),
        ));
    }

}
