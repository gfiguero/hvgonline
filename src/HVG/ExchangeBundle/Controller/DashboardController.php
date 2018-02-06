<?php

namespace HVG\ExchangeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $statuses = $em->getRepository('HVGSystemBundle:PetitionStatus')->findBy(array('result' => array(1,2)));
        $ticketRepository = $em->getRepository('HVGSystemBundle:Ticket');
        $liability_counter = array(
            1 => $ticketRepository->countByStatusLiability(1, $user),
            2 => $ticketRepository->countByStatusLiability(2, $user),
            3 => $ticketRepository->countByStatusLiability(3, $user),
            4 => $ticketRepository->countByStatusLiability(4, $user),
        );
        $zone_counter = array(
            1 => $ticketRepository->countByStatusZone(1, $user),
            2 => $ticketRepository->countByStatusZone(2, $user),
            3 => $ticketRepository->countByStatusZone(3, $user),
            4 => $ticketRepository->countByStatusZone(4, $user),
        );
//        $tickets = $em->getRepository('HVGSystemBundle:Ticket')->findBy(array('liability' => $user, 'ticketstatus' => $statuses));
        $petitions = $em->getRepository('HVGSystemBundle:Petition')->findBy(array('liability' => $user, 'petitionstatus' => $statuses));
        return $this->render('HVGExchangeBundle:Dashboard:index.html.twig', array(
            'tickets' => 0,
            'petitions' => $petitions,
            'liability_counter' => $liability_counter,
            'zone_counter' => $zone_counter,
        ));
    }
}
