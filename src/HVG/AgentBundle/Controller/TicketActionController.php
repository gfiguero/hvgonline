<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\TicketAction;
use HVG\AgentBundle\Form\TicketActionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TicketActionController extends Controller
{
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $ticketactions = $em->getRepository('HVGSystemBundle:TicketAction')->findBy(array(), array($sort => $direction));
        else $ticketactions = $em->getRepository('HVGSystemBundle:TicketAction')->findAll();
        $paginator = $this->get('knp_paginator');
        $ticketactions = $paginator->paginate($ticketactions, $request->query->getInt('page', 1), 100);

        return $this->render('HVGAgentBundle:TicketAction:index.html.twig', array(
            'ticketactions' => $ticketactions,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function showAction(TicketAction $ticketaction)
    {
        return $this->render('HVGAgentBundle:TicketAction:show.html.twig', array(
            'ticketaction' => $ticketaction,
        ));
    }

}
