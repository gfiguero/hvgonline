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
        $newTicketForm = $this->container->get('form.factory')->create($this->get('hvg_agent.form.ticket'), $ticket, array(
            'action' => $this->generateUrl('agent_ticket_new'),
        ))->createView();
//        ->setAction()->setData($ticket);

        $user = $this->get('security.token_storage')->getToken()->getUser();
        return $this->render('HVGAgentBundle:Unit:show.html.twig', array(
            'unit' => $unit,
            'newTicketForm' => $newTicketForm,
        ));
    }

}
