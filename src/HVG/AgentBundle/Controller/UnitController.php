<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Unit;
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
        $building = $unit->getBuilding();
        $community = $building->getCommunity();
        $tickets = $unit->getTickets();
        $allowances = $unit->getAllowances();
        $charges = $unit->getCharges();
        return $this->render('HVGAgentBundle:Unit:show.html.twig', array(
            'unit' => $unit,
            'building' => $building,
            'community' => $community,
            'tickets' => $tickets,
            'allowances' => $allowances,
            'charges' => $charges,
        ));
    }

}
