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
use HVG\ExchangeBundle\Form\TicketActionType;
use HVG\ExchangeBundle\Form\StatusType;

class TicketController extends Controller
{
    public function indexAction(Request $request, $status = null, Community $community = null, UnitGroup $unitgroup = null, Unit $unit = null)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();
        $unitgroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findByCommunity($community);
        $units = $em->getRepository('HVGSystemBundle:Unit')->findByUnitgroup($unitgroup);

        $sort = $request->query->has('sort') ? $request->query->get('sort') : 'updatedAt';
        $direction = $request->query->has('direction') ? $request->query->get('direction') : 'DESC';

        $tickets = $em->getRepository('HVGSystemBundle:Ticket')->findByStatus($status, $community, $unitgroup, $unit, $sort, $direction, $user);

        $paginator = $this->get('knp_paginator');
        $tickets = $paginator->paginate($tickets, $request->query->getInt('page', 1), 100);

        $ticketNewForm = null;
        if($unit) {
            $ticket = new Ticket();
            $ticketNewForm = $this->createNewTicketForm($ticket, $unit)->createView();
        }

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
            'ticketNewForm' => $ticketNewForm,
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

        $ticketAction = new TicketAction();
        $ticketActionForm = $this->createTicketActionForm($ticket, $ticketAction);
        $ticketLiabilityForm = $this->createTicketLiabilityForm($ticket);
        $ticketStatusChangeForm = $this->createTicketStatusChangeForm($ticket);

        return $this->render('HVGExchangeBundle:Ticket:show.html.twig', array(
            'status' => 0,
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'ticket' => $ticket,
            'ticketActions' => $ticketActions,
            'ticketActionForm' => $ticketActionForm->createView(),
            'ticketLiabilityForm' => $ticketLiabilityForm->createView(),
            'ticketStatusChangeForm' => $ticketStatusChangeForm->createView(),
        ));
    }

    private function createNewTicketForm(Ticket $ticket, Unit $unit)
    {
        return $this->createForm('HVG\ExchangeBundle\Form\TicketType', $ticket, array(
            'action' => $this->generateUrl('exchange_ticket_new', array('unit' => $unit->getId())),
            'unit' => $unit,
        ));
    }

    public function newAction(Request $request, Unit $unit)
    {
        $user = $this->getUser();

        $ticket = new Ticket();
        $ticketNewForm = $this->createNewTicketForm($ticket, $unit);
        $ticketNewForm->handleRequest($request);
        if ($ticketNewForm->isSubmitted()) {
            if($ticketNewForm->isValid()) {
                $ticketAction = new TicketAction();
                $ticketAction->setTicket($ticket);
                $ticketAction->setDescription('Ticket Creado.');
                $ticketAction->setUser($user);
                $ticket->setUser($user);
                $ticket->setUnit($unit);
                $ticket->setStatus(1);
                $em = $this->getDoctrine()->getManager();
                $em->persist($ticket);
                $em->persist($ticketAction);
                $em->flush();
                $email = $ticket->getContactEmail();
                if($email) {
                    $message = new \Swift_Message($ticket->getUnit()->getCommunity() . ' - Ticket ' . $ticket->getId());
                    $message->setFrom('orion@hvg.cl', 'HVG Administraciones');
                    $message->setTo($email);
                    $message->setEncoder(\Swift_Encoding::get8BitEncoding());
                    $message->setBody($this->renderView('HVGExchangeBundle:TicketEmail:new.html.twig', array('ticket' => $ticket)), 'text/html');
                    $this->get('mailer')->send($message);
                }

                return $this->redirect($this->generateUrl('exchange_ticket_index', array(
                    'status' => 0,
                    'community' => $unit->getCommunity()->getId(),
                    'unitgroup' => $unit->getUnitGroup()->getId(),
                    'unit' => $unit->getId(),
                )));
            }
        }
        $unitgroup = $unit->getUnitGroup();
        $community = $unit->getCommunity();
        return $this->render('HVGExchangeBundle:Ticket:new.html.twig', array(
            'status' => 0,
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'ticketNewForm' => $ticketNewForm->createView(),
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
        $ticketAction->setDescription('Ticket asignado a ' . $user->getPerson());

        $em = $this->getDoctrine()->getManager();
        $em->persist($ticket);
        $em->persist($ticketAction);
        $em->flush();

        return $this->redirect($this->generateUrl('exchange_ticket_show', array('ticket' => $ticket->getId())));
    }

    public function releaseAction(Ticket $ticket)
    {
        $user = $this->getUser();

        $ticket->setLiability(null);
        $ticket->setStatus(4);

        $ticketAction = new TicketAction();
        $ticketAction->setTicket($ticket);
        $ticketAction->setUser($user);
        $ticketAction->setDescription('Ticket Liberado por ' . $user->getPerson());

        $em = $this->getDoctrine()->getManager();
        $em->persist($ticket);
        $em->persist($ticketAction);
        $em->flush();

        return $this->redirect($this->generateUrl('exchange_ticket_show', array('ticket' => $ticket->getId())));
    }

    private function createEditForm(Ticket $ticket)
    {
        return $this->createForm('HVG\ExchangeBundle\Form\TicketType', $ticket, array(
            'action' => $this->generateUrl('exchange_ticket_edit', array('ticket' => $ticket->getId())),
            'unit' => $ticket->getUnit(),
        ));
    }

    public function editAction(Request $request, Ticket $ticket)
    {
        $user = $this->getUser();
        $unit = $ticket->getUnit();
        $editForm = $this->createEditForm($ticket);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $ticketAction = new TicketAction();
                $ticketAction->setTicket($ticket);
                $ticketAction->setDescription('Ticket Editado.');
                $ticketAction->setUser($user);

                $em = $this->getDoctrine()->getManager();
                $em->persist($ticket);
                $em->persist($ticketAction);
                $em->flush();

                return $this->redirect($this->generateUrl('exchange_ticket_show', array('ticket' => $ticket->getId())));
            }
        }

        $unitgroup = $unit->getUnitGroup();
        $community = $unit->getCommunity();
        return $this->render('HVGExchangeBundle:Ticket:edit.html.twig', array(
            'status' => $ticket->getStatus(),
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'ticket' => $ticket,
            'editForm' => $editForm->createView(),
        ));

    }

    private function createTicketActionForm(Ticket $ticket, TicketAction $ticketAction)
    {
        return $this->createForm('HVG\ExchangeBundle\Form\TicketActionType', $ticketAction, array(
            'action' => $this->generateUrl('exchange_ticket_action', array('ticket' => $ticket->getId())),
        ));
    }

    public function actionAction(Request $request, Ticket $ticket)
    {
        $ticketAction = new TicketAction();
        $ticketActionForm = $this->createTicketActionForm($ticket, $ticketAction);
        $ticketActionForm->handleRequest($request);
        if ($ticketActionForm->isSubmitted()) {
            if($ticketActionForm->isValid()) {
                $oldStatus = $ticket->getStatus();
                $ticket->setStatus(3);
                $ticketAction->setTicket($ticket);
                $ticketAction->setUser($this->getUser());
                $em = $this->getDoctrine()->getManager();
                $em->persist($ticketAction);
                $em->persist($ticket);
                $em->flush();
                $email = $ticket->getContactEmail();
                $sendmail = $ticketActionForm['sendmail']->getData();
                if($sendmail and $email) {
                    $message = new \Swift_Message($ticket->getUnit()->getCommunity() . ' - Ticket ' . $ticket->getId());
                    $message->setFrom('orion@hvg.cl', 'HVG Administraciones');
                    $message->setTo($email);
                    $message->setEncoder(\Swift_Encoding::get8BitEncoding());
                    $message->setBody($this->renderView('HVGExchangeBundle:TicketEmail:action.html.twig', array('ticket' => $ticket, 'reason' => $ticketAction->getDescription())), 'text/html');
                    $this->get('mailer')->send($message);
                }
            }
        }
        return $this->redirect($this->generateUrl('exchange_ticket_show', array('ticket' => $ticket->getId())));
    }

    private function createTicketLiabilityForm(Ticket $ticket)
    {
        return $this->createForm('HVG\ExchangeBundle\Form\TicketLiabilityType', $ticket, array(
            'action' => $this->generateUrl('exchange_ticket_liability', array('ticket' => $ticket->getId())),
        ));
    }

    public function liabilityAction(Request $request, Ticket $ticket)
    {
        $ticketLiabilityForm = $this->createTicketLiabilityForm($ticket);
        $ticketLiabilityForm->handleRequest($request);
        if ($ticketLiabilityForm->isSubmitted()) {
            if($ticketLiabilityForm->isValid()) {
                $ticketAction = new TicketAction();
                $ticketAction->setTicket($ticket);
                $ticketAction->setUser($this->getUser());
                $ticketAction->setDescription('Ticket reasignado a ' . $ticketLiabilityForm['liability']->getData()->getPerson() . '. Causa: ' . $ticketLiabilityForm['reason']->getData());

                $ticket->setStatus(2);

                $em = $this->getDoctrine()->getManager();
                $em->persist($ticketAction);
                $em->persist($ticket);
                $em->flush();
            }
        }
        return $this->redirect($this->generateUrl('exchange_ticket_show', array('ticket' => $ticket->getId())));
    }

    private function createTicketStatusChangeForm(Ticket $ticket)
    {
        return $this->createForm('HVG\ExchangeBundle\Form\TicketStatusChangeType', $ticket, array(
            'action' => $this->generateUrl('exchange_ticket_status', array('ticket' => $ticket->getId())),
        ));
    }

    public function statusAction(Request $request, Ticket $ticket)
    {
        $ticketStatusChangeForm = $this->createTicketStatusChangeForm($ticket);
        $ticketStatusChangeForm->handleRequest($request);
        if ($ticketStatusChangeForm->isSubmitted()) {
            if($ticketStatusChangeForm->isValid()) {
                $newStatus = $ticketStatusChangeForm['status']->getData();
                $reason = $ticketStatusChangeForm['reason']->getData();
                $sendmail = $ticketStatusChangeForm['sendmail']->getData();
                $ticketstatuses = $this->container->getParameter('ticketstatuses');

                $ticketAction = new TicketAction();
                $ticketAction->setTicket($ticket);
                $ticketAction->setUser($this->getUser());
                $ticketAction->setDescription('Cambio de estado: ' . $ticketstatuses[$newStatus] . '. Causa: ' . $reason);
                $ticketAction->setSendmail($sendmail);

                $em = $this->getDoctrine()->getManager();
                $em->persist($ticketAction);
                $em->persist($ticket);
                $em->flush();

                $email = $ticket->getContactEmail();
                if($sendmail and $email) {
                    $message = new \Swift_Message($ticket->getUnit()->getCommunity() . ' - Ticket ' . $ticket->getId());
                    $message->setFrom('orion@hvg.cl', 'HVG Administraciones');
                    $message->setTo($email);
                    $message->setEncoder(\Swift_Encoding::get8BitEncoding());
                    $message->setBody($this->renderView('HVGExchangeBundle:TicketEmail:status.html.twig', array('ticket' => $ticket, 'status' => $ticket->getStatus(), 'reason' => $reason)), 'text/html');
                    $this->get('mailer')->send($message);
                }
            }
        }
        return $this->redirect($this->generateUrl('exchange_ticket_show', array('ticket' => $ticket->getId())));
    }

    public function testAction(Request $request, Ticket $ticket)
    {
        return $this->render('HVGExchangeBundle:TicketEmail:action.html.twig', array('ticket' => $ticket, 'reason' => 'prueba de email'));
    }

}
