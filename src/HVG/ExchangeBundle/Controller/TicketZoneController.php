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
use HVG\ExchangeBundle\Form\StatusType;

class TicketZoneController extends Controller
{
    public function indexAction(Request $request, $status = null, Community $community = null, UnitGroup $unitgroup = null, Unit $unit = null)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        //$communities = $em->getRepository('HVGSystemBundle:Community')->findAll();
        $zones = $user->getZones();
        $communities = $user->getCommunitiesFromZones();
        $unitgroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findByCommunity($community);
        $units = $em->getRepository('HVGSystemBundle:Unit')->findByUnitgroup($unitgroup);

        $sort = $request->query->has('sort') ? $request->query->get('sort') : 'createdAt';
        $direction = $request->query->has('direction') ? $request->query->get('direction') : 'DESC';

        $tickets = $em->getRepository('HVGSystemBundle:Ticket')->findByUser($status, $community, $unitgroup, $unit, $sort, $direction, $user);

        $paginator = $this->get('knp_paginator');
        $tickets = $paginator->paginate($tickets, $request->query->getInt('page', 1), 100);

        return $this->render('HVGExchangeBundle:Ticket:index.html.twig', array(
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

    public function showAction(Ticket $ticket)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $status = $ticket->getStatus();
        $unit = $ticket->getUnit();
        $unitgroup = $unit->getUnitGroup();
        $community = $unit->getCommunity();

        $ticketActions = $em->getRepository('HVGSystemBundle:TicketAction')->findByTicket(array('id' => $ticket->getId()), array('createdAt' => 'DESC'));

        return $this->render('HVGExchangeBundle:Ticket:show.html.twig', array(
            'status' => 0,
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'ticket' => $ticket,
            'ticketActions' => $ticketActions,
        ));
    }

    public function takeAction(Ticket $ticket)
    {
        $user = $this->getUser();

        $ticket->setLiability($user);
        $ticket->setStatus(2);

        $ticketAction = new TicketAction();
        $ticketAction->setTicket($ticket);
        $ticketAction->setUser($user);
        $ticketAction->setDescription('Ticket Asignado a ' . $user->getPerson());

        $em = $this->getDoctrine()->getManager();
        $em->persist($ticket);
        $em->persist($ticketAction);
        $em->flush();

        return $this->redirect($this->generateUrl('exchange_ticket_show', array('ticket' => $ticket->getId())));
    }

    public function statusAction(Request $request, Ticket $ticket)
    {
        $user = $this->getUser();
        $unit = $ticket->getUnit();
        $unitgroup = $unit->getUnitGroup();
        $community = $unit->getCommunity();

        $statusForm = $this->createForm('HVG\ExchangeBundle\Form\StatusType', $ticket);
        $statusForm->handleRequest($request);

        if ($statusForm->isSubmitted()) {
            if($statusForm->isValid()) {
                dump($statusForm->getData());
                die();
                return $this->redirect($this->generateUrl('exchange_ticket_show', array('ticket' => $ticket->getId())));
            }
        }

        return $this->render('HVGExchangeBundle:Ticket:status.html.twig', array(
            'unit' => $unit,
            'unitgroup' => $unitgroup,
            'community' => $community,
            'ticket' => $ticket,
            'status' => 0,
            'statusForm' => $statusForm->createView(),
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
                $ticketAction->setDescription('Ticket Creado. Estado: '.$ticket->getTicketStatus());
                $ticketAction->setUser($this->get('security.token_storage')->getToken()->getUser());

                $ticket->setUser($this->get('security.token_storage')->getToken()->getUser());
                $em->persist($ticket);
                $em->persist($ticketAction);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'ticket.new.flash' );
                return $this->redirect($this->generateUrl('agent_ticket_show', array('id' => $ticket->getId())));
            }
        }

        $tickets = array();
        $ticketFilter = new TicketFilter();
        $ticketFilterForm = $this->createTicketFilterForm($ticketFilter);

        return $this->render('HVGExchangeBundle:Ticket:new.html.twig', array(
            'ticketFilterForm' => $ticketFilterForm->createView(),
            'tickets' => $tickets,
        ));
    }

    public function newPetitionAction(Request $request, Ticket $ticket)
    {
        $petition = new Petition();
        $petitionForm = $this->createNewPetitionForm($ticket, $petition);
        $petitionForm->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        if ($petitionForm->isSubmitted()) {
            if($petitionForm->isValid()) {
                $ticketAction = new TicketAction();
                $ticketAction->setTicket($ticket);
                $ticketAction->setDescription('Requerimiento Creado');
                $ticketAction->setUser($this->get('security.token_storage')->getToken()->getUser());
                $petition->setUser($this->get('security.token_storage')->getToken()->getUser());
                $ticket->addTicketpetition($petition);

                $em->persist($ticket);
                $em->persist($ticketAction);
                $em->persist($petition);

                $petitionAction = new PetitionAction();
                $petitionAction->setPetition($petition);
                $petitionAction->setDescription('Requerimiento Creado. Estado: '.$petition->getPetitionStatus());
                $petitionAction->setUser($this->get('security.token_storage')->getToken()->getUser());
                $em->persist($petitionAction);

                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'petition.new.flash' );
                return $this->redirect($this->generateUrl('agent_petition_show', array('id' => $petition->getId())));
            }
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
                    if ($unit) {
                        $ticket = new Ticket();
                        $ticket->setUnit($unit);
                        $newForm = $this->container->get('form.factory')->create($this->get('hvg_agent.form.ticket'), $ticket, array(
                            'action' => $this->generateUrl('agent_ticket_new'),
                        ));
                        return $this->render('HVGExchangeBundle:Ticket:filter.html.twig', array(
                            'ticketFilterForm' => $ticketFilterForm->createView(),
                            'newForm' => $newForm->createView(),
                            'unit' => $unit,
                        ));
                    }
                    return $this->render('HVGExchangeBundle:Ticket:filter.html.twig', array(
                        'ticketFilterForm' => $ticketFilterForm->createView(),
                    ));
                }
            }
            $response = new Response();
            $response->setStatusCode(500);
            return $response;
        }
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
                $request->getSession()->getFlashBag()->add( 'success', 'ticket.edit.flash' );
            }
        }

        return $this->redirect($request->headers->get('referer'));
    }

    private function createNewActionForm(TicketAction $ticketAction)
    {
        return $this->createForm('HVG\ExchangeBundle\Form\TicketActionType', $ticketAction, array(
            'action' => $this->generateUrl('agent_ticketaction_new'),
        ));
    }

    private function createTicketStatusForm(Ticket $ticket)
    {
        return $this->createForm('HVG\ExchangeBundle\Form\TicketStatusType', $ticket, array(
            'action' => $this->generateUrl('agent_ticket_status', array('id' => $ticket->getId())),
        ));
    }

    private function createNewPetitionForm(Ticket $ticket, Petition $petition)
    {
        return $this->createForm('HVG\ExchangeBundle\Form\PetitionType', $petition, array(
            'action' => $this->generateUrl('agent_ticket_newpetition', array('id' => $ticket->getId())),
        ));
    }

    private function createTicketFilterForm(TicketFilter $ticketFilter)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $communities = $user->getCommunities();
        $unitgroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findBy(array('community' => $communities->toArray()));
        $units = $em->getRepository('HVGSystemBundle:Unit')->findBy(array('community' => $communities->toArray()));
        return $this->createForm('HVG\ExchangeBundle\Form\TicketFilterType', $ticketFilter, array(
            'action' => $this->generateUrl('agent_ticket_filter'),
            'communities' => $communities,
            'unitgroups' => $unitgroups,
            'units' => $units,
        ));
    }

    private function createEditForm(Ticket $ticket)
    {
        return $this->createForm('HVG\ExchangeBundle\Form\TicketType', $ticket, array(
            'action' => $this->generateUrl('agent_ticket_edit', array('id' => $ticket->getId())),
        ));
    }

    public function areaAction(Request $request)
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
        return $this->render('HVGExchangeBundle:Ticket:area.html.twig', array(
            'tickets' => $tickets,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function sentAction(Request $request)
    {
        $user = $this->getUser();
        $areas = $user->getAreas();
        $communities = $user->getCommunities();
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        $units = $em->getRepository('HVGSystemBundle:Unit')->findBy(array('community' => $communities->toArray()));
        $statuses = $em->getRepository('HVGSystemBundle:TicketStatus')->findBy(array('result' => array(1,2,3)));
        if($sort) $tickets = $em->getRepository('HVGSystemBundle:Ticket')->findBy(array('user' => $user, 'unit' => $units, 'ticketstatus' => $statuses), array($sort => $direction));
        else $tickets = $em->getRepository('HVGSystemBundle:Ticket')->findBy(array('user' => $user, 'unit' => $units, 'ticketstatus' => $statuses));
        $paginator = $this->get('knp_paginator');
        $tickets = $paginator->paginate($tickets, $request->query->getInt('page', 1), 100);
        return $this->render('HVGExchangeBundle:Ticket:sent.html.twig', array(
            'tickets' => $tickets,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function receivedAction(Request $request)
    {
        $user = $this->getUser();
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        $statuses = $em->getRepository('HVGSystemBundle:TicketStatus')->findBy(array('result' => array(1,2,3)));
        if($sort) $tickets = $em->getRepository('HVGSystemBundle:Ticket')->findBy(array('liability' => $user, 'ticketstatus' => $statuses), array($sort => $direction));
        else $tickets = $em->getRepository('HVGSystemBundle:Ticket')->findBy(array('liability' => $user, 'ticketstatus' => $statuses));
        $paginator = $this->get('knp_paginator');
        $tickets = $paginator->paginate($tickets, $request->query->getInt('page', 1), 100);
        return $this->render('HVGExchangeBundle:Ticket:received.html.twig', array(
            'tickets' => $tickets,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

}
