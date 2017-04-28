<?php

namespace HVG\AgentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use HVG\SystemBundle\Entity\Ticket;
use HVG\SystemBundle\Entity\TicketAction;
use HVG\AgentBundle\Form\TicketType;
use HVG\AgentBundle\Entity\TicketFilter;
use HVG\AgentBundle\Form\TicketFilterType;

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

        $ticketFilter = new TicketFilter();
        $ticketFilterForm = $this->createTicketFilterForm($ticketFilter);
        return $this->render('HVGAgentBundle:Ticket:index.html.twig', array(
            'ticketFilterForm' => $ticketFilterForm->createView(),
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
        $newForm = $this->container->get('form.factory')->create($this->get('hvg_agent.form.ticket'), $ticket, array(
            'action' => $this->generateUrl('agent_ticket_new'),
        ));
        $newForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $ticketAction = new TicketAction();
                $ticketAction->setTicket($ticket);
                $ticketAction->setDescription('Ticket Creado. Estado: '.$ticket->getStatus());
                $ticketAction->setUser($this->get('security.token_storage')->getToken()->getUser());

                $ticket->setUser($this->get('security.token_storage')->getToken()->getUser());
                $em->persist($ticket);
                $em->persist($ticketAction);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'ticket.flash.created' );
                return $this->redirect($request->headers->get('referer'));
            }
        }

//        $session = $request->getSession();
//        $ticketFilter = $session->get('ticketFilter', new TicketFilter());
//        $ticketFilterForm = $this->createTicketFilterForm($em->merge($ticketFilter));
        $ticketFilter = new TicketFilter();
        $ticketFilterForm = $this->createTicketFilterForm($ticketFilter);

        return $this->render('HVGAgentBundle:Ticket:new.html.twig', array(
            'ticket' => $ticket,
            'newForm' => $newForm->createView(),
            'ticketFilterForm' => $ticketFilterForm->createView(),
        ));
    }

    public function searchAction(Request $request)
    {
        if($request->isXmlHttpRequest()) {
            $ticketFilter = new TicketFilter();
            $ticketFilterForm = $this->createTicketFilterForm($ticketFilter);
            $ticketFilterForm->handleRequest($request);
            if ($ticketFilterForm->isSubmitted()) {
                if($ticketFilterForm->isValid()) {
                    $unit = $ticketFilter->getUnit();
                    if ($unit) {
                        $ticket = new Ticket();
                        $ticket->setUnit($unit);
                        $newForm = $this->container->get('form.factory')->create($this->get('hvg_agent.form.ticket'), $ticket, array(
                            'action' => $this->generateUrl('agent_ticket_new'),
                        ));
                        return $this->render('HVGAgentBundle:Ticket:filter.html.twig', array(
                            'ticketFilterForm' => $ticketFilterForm->createView(),
                            'newForm' => $newForm->createView(),
                            'unit' => $unit,
                        ));
                    }
                    return $this->render('HVGAgentBundle:Ticket:filter.html.twig', array(
                        'ticketFilterForm' => $ticketFilterForm->createView(),
                    ));
                }
            }
            $response = new Response();
            $response->setStatusCode(500);
            return $response;
        }
    }

    public function filterAction(Request $request)
    {
        if($request->isXmlHttpRequest()) {
            $ticketFilter = new TicketFilter();
            $ticketFilterForm = $this->createTicketFilterForm($ticketFilter);
            $ticketFilterForm->handleRequest($request);
            if ($ticketFilterForm->isSubmitted()) {
                if($ticketFilterForm->isValid()) {
                    $unit = $ticketFilter->getUnit();
                    $unitgroup = $ticketFilter->getUnitGroup();
                    $em = $this->getDoctrine()->getManager();
                    $tickets = $em->getRepository('HVGSystemBundle:Ticket')->findByFilter($unit, $unitgroup);
                    return $this->render('HVGAgentBundle:Ticket:list.html.twig', array(
                        'tickets' => $tickets,
                    ));
                }
            }
            $response = new Response();
            $response->setStatusCode(500);
            return $response;
        }
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

    private function createTicketFilterForm(TicketFilter $ticketFilter)
    {
        return $this->createForm('HVG\AgentBundle\Form\TicketFilterType', $ticketFilter, array(
            'action' => $this->generateUrl('agent_ticket_search'),
        ));
    }

    private function createEditForm(Ticket $ticket)
    {
        return $this->createForm('HVG\AgentBundle\Form\TicketType', $ticket, array(
            'action' => $this->generateUrl('agent_ticket_edit', array('id' => $ticket->getId())),
        ));
    }

    public function myAction(Request $request)
    {
        $user = $this->getUser();
        $areas = $user->getAreas();
        $communities = $user->getCommunities();
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        $units = $em->getRepository('HVGSystemBundle:Unit')->findBy(array('community' => $communities->toArray()));
        $statuses = $em->getRepository('HVGSystemBundle:TicketStatus')->findBy(array('result' => array(1,2,3)));
        if($sort) $tickets = $em->getRepository('HVGSystemBundle:Ticket')->findBy(array('area' => $areas->toArray(), 'unit' => $units, 'ticketstatus' => $statuses), array($sort => $direction));
        else $tickets = $em->getRepository('HVGSystemBundle:Ticket')->findBy(array('area' => $areas->toArray(), 'unit' => $units, 'ticketstatus' => $statuses));
        $paginator = $this->get('knp_paginator');
        $tickets = $paginator->paginate($tickets, $request->query->getInt('page', 1), 100);

//        $tickets = $em->getRepository('HVGSystemBundle:Ticket')->findByAreaCommunity($areas, $communities);
        return $this->render('HVGAgentBundle:Ticket:my.html.twig', array(
            'tickets' => $tickets,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

}
