<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Petition;
use HVG\AgentBundle\Form\PetitionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PetitionController extends Controller
{
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $units = $em->getRepository('HVGSystemBundle:Petition')->findBy(array(), array($sort => $direction));
        else $units = $em->getRepository('HVGSystemBundle:Petition')->findAll();
        $paginator = $this->get('knp_paginator');
        $units = $paginator->paginate($units, $request->query->getInt('page', 1), 100);

        return $this->render('HVGAgentBundle:Petition:index.html.twig', array(
            'unit' => $units,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function showAction(Petition $ticket)
    {
        $unit = $ticket->getUnit();
        $unitgroup = $unit->getUnitGroup();
        $community = $unitgroup->getCommunity();

        return $this->render('HVGAgentBundle:Petition:show.html.twig', array(
            'ticket' => $ticket,
            'unit' => $unit,
            'unitgroup' => $unitgroup,
            'community' => $community,
        ));
    }

}
