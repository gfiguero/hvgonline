<?php

namespace HVG\PublicBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\Ticket;
use HVG\PublicBundle\Form\TicketType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TicketController extends Controller
{
    public function newAction(Request $request, $hash)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);

        $ticket = new Ticket();
        $newForm = $this->createForm(new TicketType(), $ticket, array('community' => $community));
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $ticket->setStatus(1);
                $em = $this->getDoctrine()->getManager();
                $em->persist($ticket);
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
                return $this->redirect($this->generateUrl('public_dashboard_index', array('hash' => $hash)));
            }
        }
        return $this->render('HVGPublicBundle:Ticket:new.html.twig', array(
            'newForm' => $newForm->createView(),
            'community' => $community,
        ));
    }
}
