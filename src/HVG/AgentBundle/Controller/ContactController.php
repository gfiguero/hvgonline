<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $contacts = $em->getRepository('HVGSystemBundle:Contact')->findBy(array(), array($sort => $direction));
        else $contacts = $em->getRepository('HVGSystemBundle:Contact')->findAll();
        $paginator = $this->get('knp_paginator');
        $contacts = $paginator->paginate($contacts, $request->query->getInt('page', 1), 100);

        return $this->render('HVGAgentBundle:Contact:index.html.twig', array(
            'contacts' => $contacts,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function showAction(Contact $contact)
    {
        return $this->render('HVGAgentBundle:Contact:show.html.twig', array(
            'contact' => $contact,
        ));
    }

}
