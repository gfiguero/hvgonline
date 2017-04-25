<?php

namespace HVG\AgentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use HVG\SystemBundle\Entity\Ticket;
use HVG\AgentBundle\Entity\TicketFilter;
use HVG\AgentBundle\Form\TicketFilterType;

class DashboardController extends Controller
{
    public function indexAction()
    {
        $ticket = new Ticket();
        $newTicketForm = $this->createNewTicketForm($ticket);

        return $this->render('HVGAgentBundle:Dashboard:index.html.twig', array(
            'newTicketForm' => $newTicketForm->createView(),
        ));
    }

    private function createNewTicketForm(Ticket $ticket)
    {
        return $this->createForm('HVG\AgentBundle\Form\TicketFilterType', $ticket, array(
            'action' => $this->generateUrl('agent_dashboard_findunit'),
        ));
    }
}
