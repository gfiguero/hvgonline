<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\PetitionAction;
use HVG\AgentBundle\Form\PetitionActionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PetitionActionController extends Controller
{
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $petitionactions = $em->getRepository('HVGSystemBundle:PetitionAction')->findBy(array(), array($sort => $direction));
        else $petitionactions = $em->getRepository('HVGSystemBundle:PetitionAction')->findBy(array(), array('createdAt' => 'DESC'));
        $paginator = $this->get('knp_paginator');
        $petitionactions = $paginator->paginate($petitionactions, $request->query->getInt('page', 1), 100);

        return $this->render('HVGAgentBundle:PetitionAction:index.html.twig', array(
            'petitionactions' => $petitionactions,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function showAction(PetitionAction $petitionaction)
    {
        return $this->render('HVGAgentBundle:PetitionAction:show.html.twig', array(
            'petitionaction' => $petitionaction,
        ));
    }

    public function newAction(Request $request)
    {
        $petitionAction = new PetitionAction();
        $newPetitionActionForm = $this->createForm('HVG\AgentBundle\Form\PetitionActionType', $petitionAction, array(
            'action' => $this->generateUrl('agent_petitionaction_new'),
        ));
        $newPetitionActionForm->handleRequest($request);

        if ($newPetitionActionForm->isSubmitted()) {
            if($newPetitionActionForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $petitionAction->setUser($this->get('security.token_storage')->getToken()->getUser());
                $petitionAction->getPetition()->setUpdated();
                $em->persist($petitionAction);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'petitionaction.new.flash' );
            }
        }

        return $this->redirect($request->headers->get('referer'));
    }

}
