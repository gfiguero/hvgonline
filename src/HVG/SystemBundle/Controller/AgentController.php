<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Agent;
use HVG\SystemBundle\Form\AgentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Agent controller.
 *
 */
class AgentController extends Controller
{

    /**
     * Lists all Agent entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $agents = $em->getRepository('HVGSystemBundle:Agent')->findBy(array(), array($sort => $direction));
        else $agents = $em->getRepository('HVGSystemBundle:Agent')->findAll();
        $paginator = $this->get('knp_paginator');
        $agents = $paginator->paginate($agents, $request->query->getInt('page', 1), 100);
        $agent = new Agent();
        $newForm = $this->createNewForm($agent)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($agents as $key => $agent) {
            $editForms[] = $this->createEditForm($agent)->createView();
            $deleteForms[] = $this->createDeleteForm($agent)->createView();
        }

        return $this->render('agent/index.html.twig', array(
            'agents' => $agents,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Agent entity.
     *
     */
    public function newAction(Request $request)
    {
        $agent = new Agent();
        $newForm = $this->createNewForm($agent);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($agent);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'agent.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new Agent entity.
     *
     * @param Agent $agent The Agent entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Agent $agent)
    {
        return $this->createForm('HVG\SystemBundle\Form\AgentType', $agent, array(
            'action' => $this->generateUrl('agent_new'),
        ));
    }

    /**
     * Finds and displays a Agent entity.
     *
     */
    public function showAction(Agent $agent)
    {
        $editForm = $this->createEditForm($agent);
        $deleteForm = $this->createDeleteForm($agent);

        return $this->render('agent/show.html.twig', array(
            'agent' => $agent,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Agent entity.
     *
     */
    public function editAction(Request $request, Agent $agent)
    {
        $editForm = $this->createEditForm($agent);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($agent);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'agent.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a Agent entity.
     *
     * @param Agent $agent The Agent entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Agent $agent)
    {
        return $this->createForm('HVG\SystemBundle\Form\AgentType', $agent, array(
            'action' => $this->generateUrl('agent_edit', array('id' => $agent->getId())),
        ));
    }

    /**
     * Deletes a Agent entity.
     *
     */
    public function deleteAction(Request $request, Agent $agent)
    {
        $deleteForm = $this->createDeleteForm($agent);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($agent);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'agent.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a Agent entity.
     *
     * @param Agent $agent The Agent entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Agent $agent)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('agent_delete', array('id' => $agent->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
