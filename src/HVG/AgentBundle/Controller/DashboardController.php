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
        $areas = $user->getAreas();
        $communities = $user->getCommunities();
        $em = $this->getDoctrine()->getManager();
        $units = $em->getRepository('HVGSystemBundle:Unit')->findBy(array('community' => $communities->toArray()));
        $statuses = $em->getRepository('HVGSystemBundle:PetitionStatus')->findBy(array('result' => array(1,2)));
        $tickets = $em->getRepository('HVGSystemBundle:Ticket')->findBy(array('area' => $areas->toArray(), 'unit' => $units, 'ticketstatus' => $statuses));
        $petitions = $em->getRepository('HVGSystemBundle:Petition')->findBy(array('liability' => $user, 'community' => $communities->toArray(), 'petitionstatus' => $statuses));
        return $this->render('HVGAgentBundle:Dashboard:index.html.twig', array(
            'tickets' => $tickets,
            'petitions' => $petitions,
        ));
    }
}
