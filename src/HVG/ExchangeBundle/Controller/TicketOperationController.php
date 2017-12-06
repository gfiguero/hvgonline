<?php

namespace HVG\ExchangeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\Ticket;
use HVG\SystemBundle\Entity\TicketAction;

use HVG\ExchangeBundle\Form\TicketType;

class TicketOperationController extends Controller
{
    public function indexAction(Request $request, $status = null, Community $community = null, UnitGroup $unitgroup = null, Unit $unit = null)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();
        $unitgroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findByCommunity($community);
        $units = $em->getRepository('HVGSystemBundle:Unit')->findByUnitgroup($unitgroup);

        $sort = $request->query->has('sort') ? $request->query->get('sort') : 'createdAt';
        $direction = $request->query->has('direction') ? $request->query->get('direction') : 'DESC';

        if($unit){
            $tickets = $em->getRepository('HVGSystemBundle:Ticket')->findByUnit($status, $unit, $sort, $direction);
        } elseif ($unitgroup) {
            $tickets = $em->getRepository('HVGSystemBundle:Ticket')->findByUnitgroup($status, $unitgroup, $sort, $direction);
        } elseif ($community) {
            $tickets = $em->getRepository('HVGSystemBundle:Ticket')->findByCommunity($status, $community, $sort, $direction);
        } else {
            $tickets = $em->getRepository('HVGSystemBundle:Ticket')->findByStatus($status, $sort, $direction);
        }

        $paginator = $this->get('knp_paginator');
        $tickets = $paginator->paginate($tickets, $request->query->getInt('page', 1), 100);

        return $this->render('HVGExchangeBundle:TicketOperation:index.html.twig', array(
            'communities' => $communities,
            'unitgroups' => $unitgroups,
            'units' => $units,
            'status' => $status,
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'tickets' => $tickets,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function newAction(Request $request, Unit $unit)
    {
        $ticket = new Ticket();
        $newForm = $this->createForm(new TicketType(), $ticket);
        $newForm->handleRequest($request);

        $community = $unit->getCommunity();
        $unitgroup = $unit->getUnitgroup();

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $ticketAction = new TicketAction();
                $ticketAction->setTicket($ticket);
                $ticketAction->setDescription('Ticket Creado.');
                $ticketAction->setUser($this->get('security.token_storage')->getToken()->getUser());

                $ticket->setUser($this->get('security.token_storage')->getToken()->getUser());
                $ticket->setUnit($unit);
                $ticket->setStatus(1);
                $em->persist($ticket);
                $em->persist($ticketAction);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'ticket.new.flash' );
                return $this->redirect($this->generateUrl('exchange_ticketoperation_show', array('ticket' => $ticket->getId())));
            }
        }

        return $this->render('HVGExchangeBundle:TicketOperation:new.html.twig', array(
            'status' => 0,
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'newForm' => $newForm->createView(),
        ));
    }

    public function showAction(Ticket $ticket)
    {
        $unit = $ticket->getUnit();
        $unitgroup = $unit->getUnitgroup();
        $community = $unit->getCommunity();

        return $this->render('HVGExchangeBundle:TicketOperation:show.html.twig', array(
            'status' => 0,
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'ticket' => $ticket,
        ));
    }

    public function editAction(Request $request, Ticket $ticket)
    {
        $editForm = $this->createForm(new TicketType(), $ticket);
        $editForm->handleRequest($request);

        $status = $ticket->getStatus();
        $unit = $ticket->getUnit();
        $community = $unit->getCommunity();
        $unitgroup = $unit->getUnitgroup();

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
                $request->getSession()->getFlashBag()->add( 'success', 'ticket.edit.flash' );
                return $this->redirect($this->generateUrl('exchange_ticketoperation_show', array('ticket' => $ticket->getId())));
            }
        }

        return $this->render('HVGExchangeBundle:TicketOperation:edit.html.twig', array(
            'status' => $status,
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'editForm' => $editForm->createView(),
        ));
    }


}
