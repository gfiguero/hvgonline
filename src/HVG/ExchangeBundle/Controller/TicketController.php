<?php

namespace HVG\ExchangeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use HVG\SystemBundle\Entity\Ticket;
use HVG\SystemBundle\Entity\TicketAction;
use HVG\SystemBundle\Entity\Petition;
use HVG\SystemBundle\Entity\PetitionAction;

use HVG\ExchangeBundle\Form\TicketType;
use HVG\ExchangeBundle\Form\TicketFilterType;
use HVG\ExchangeBundle\Form\PetitionType;
use HVG\ExchangeBundle\Entity\TicketFilter;

class TicketController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $communities = $user->getCommunities();
        $unitgroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findBy(array('community' => $communities->toArray()));
        $units = $em->getRepository('HVGSystemBundle:Unit')->findBy(array('community' => $communities->toArray()));
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        if($sort) $tickets = $em->getRepository('HVGSystemBundle:Ticket')->findBy(array('unit' => $units), array($sort => $direction));
        else $tickets = $em->getRepository('HVGSystemBundle:Ticket')->findBy(array('unit' => $units));
        $paginator = $this->get('knp_paginator');
        $tickets = $paginator->paginate($tickets, $request->query->getInt('page', 1), 100);
        $ticketFilter = new TicketFilter();
        $ticketFilterForm = $this->createTicketFilterForm($ticketFilter);
        return $this->render('HVGExchangeBundle:Ticket:index.html.twig', array(
            'ticketFilterForm' => $ticketFilterForm->createView(),
            'tickets' => $tickets,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function prepareAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $communities = $user->getCommunities();
        $unitgroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findBy(array('community' => $communities->toArray()));
        $units = $em->getRepository('HVGSystemBundle:Unit')->findBy(array('community' => $communities->toArray()));
        $tickets = array();
        $ticketFilter = new TicketFilter();
        $ticketFilterForm = $this->createTicketFilterForm($ticketFilter);
        return $this->render('HVGExchangeBundle:Ticket:prepare.html.twig', array(
            'ticketFilterForm' => $ticketFilterForm->createView(),
            'tickets' => $tickets,
        ));
    }

    public function showAction(Ticket $ticket)
    {
        $em = $this->getDoctrine()->getManager();
        $ticketActions = $em->getRepository('HVGSystemBundle:TicketAction')->findByTicket(array('id' => $ticket->getId()), array('createdAt' => 'DESC'));
        $ticketAction = new TicketAction();
        $ticketAction->setTicket($ticket);
        $newTicketActionForm = $this->createNewActionForm($ticketAction)->createView();
/*        $newTicketActionForm = $this->container->get('form.factory')->create($this->get('hvg_agent.form.ticketaction'), $ticketAction, array(
            'action' => $this->generateUrl('agent_ticketaction_new'),
        ))->createView();*/
        $ticketStatusForm = $this->createTicketStatusForm($ticket)->createView();
        $editForm = $this->createEditForm($ticket)->createView();

        $petition = new Petition();
        $petition->setExpiry(new \DateTime('+2 days'));
        $petition->setArea($ticket->getArea());
        $petition->setCommunity($ticket->getCommunity());
        $petitionForm = $this->createNewPetitionForm($ticket, $petition);

        return $this->render('HVGExchangeBundle:Ticket:show.html.twig', array(
            'ticket' => $ticket,
            'ticketActions' => $ticketActions,
            'newTicketActionForm' => $newTicketActionForm,
            'ticketStatusForm' => $ticketStatusForm,
            'editForm' => $editForm,
            'petitionForm' => $petitionForm->createView(),
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

    public function searchAction(Request $request)
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
                    return $this->render('HVGExchangeBundle:Ticket:list.html.twig', array(
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
                $request->getSession()->getFlashBag()->add( 'success', 'ticket.editstatus.flash' );
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
