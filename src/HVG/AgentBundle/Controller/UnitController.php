<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\Ticket;
use HVG\AgentBundle\Form\TicketType;

use HVG\AgentBundle\Form\UnitFilter;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UnitController extends Controller
{
    public function indexAction(Request $request, Community $community = null, UnitGroup $unitgroup = null, Unit $unit = null)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();
        $unitgroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findByCommunity($community);
        $units = $em->getRepository('HVGSystemBundle:Unit')->findByUnitgroup($unitgroup);

        return $this->render('HVGAgentBundle:Unit:index.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'communities' => $communities,
            'unitgroups' => $unitgroups,
            'units' => $units,
        ));
    }

    public function unitgroupAction(Request $request, UnitGroup $unitgroup)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();
        if($sort) $units = $em->getRepository('HVGSystemBundle:Unit')->findBy(array('unitgroup' => $unitgroup), array($sort => $direction));
        else $units = $em->getRepository('HVGSystemBundle:Unit')->findBy(array('unitgroup' => $unitgroup));
        $paginator = $this->get('knp_paginator');
        $units = $paginator->paginate($units, $request->query->getInt('page', 1), 100);

        return $this->render('HVGAgentBundle:Unit:unitgroup.html.twig', array(
            'communities' => $communities,
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

        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();

        $user = $this->get('security.token_storage')->getToken()->getUser();
        return $this->render('HVGAgentBundle:Unit:show.html.twig', array(
            'communities' => $communities,
            'unit' => $unit,
            'newTicketForm' => $newTicketForm,
        ));
    }

}
