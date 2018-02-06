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
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $statuses = $em->getRepository('HVGSystemBundle:PetitionStatus')->findBy(array('result' => array(1,2)));
        $tickets = $em->getRepository('HVGSystemBundle:Ticket')->findBy(array('liability' => $user, 'ticketstatus' => $statuses));
        $petitions = $em->getRepository('HVGSystemBundle:Petition')->findBy(array('liability' => $user, 'petitionstatus' => $statuses));
        return $this->render('HVGAgentBundle:Dashboard:index.html.twig', array(
            'tickets' => 0,
            'petitions' => $petitions,
        ));
    }
}
