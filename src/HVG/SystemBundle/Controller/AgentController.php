<?php

namespace HVG\SystemBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HVG\SystemBundle\Entity\Agent;
use HVG\SystemBundle\Form\AgentType;

class AgentController extends Controller
{
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $agents = $em->getRepository('HVGSystemBundle:Agent')->findBy(array(), array($sort => $direction));
        else $agents = $em->getRepository('HVGSystemBundle:Agent')->findAll();
        $paginator = $this->get('knp_paginator');
        $agents = $paginator->paginate($agents, $request->query->getInt('page', 1), 24);

        $deleteForms = array();
        $editForms = array();
        $agent = new Agent();
        $newForm = $this->createForm('HVG\SystemBundle\Form\AgentType', $agent, array(
            'action' => $this->generateUrl('agent_new'),
        ))->createView();

        foreach ($agents as $key => $agent) {
            $editForms[] = $this->createForm('HVG\SystemBundle\Form\AgentType', $agent, array(
                'action' => $this->generateUrl('agent_edit', array('id' => $agent->getId())),
            ))->createView();
            $deleteForms[] = $this->createDeleteForm($agent, array(
                'action' => $this->generateUrl('agent_delete', array('id' => $agent->getId())),
            ))->createView();
        }

        return $this->render('HVGSystemBundle:Agent:index.html.twig', array(
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
        $form = $this->createForm('HVG\SystemBundle\Form\AgentType', $agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($agent);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'agent.new.flash' );

        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Displays a form to edit an existing Agent entity.
     *
     */
    public function editAction(Request $request, Agent $agent)
    {
        $deleteForm = $this->createDeleteForm($agent);
        $editForm = $this->createForm('HVG\SystemBundle\Form\AgentType', $agent);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($agent);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'agent.edit.flash' );

            return $this->redirect($request->headers->get('referer'));
        }

        return $this->render('agent/edit.html.twig', array(
            'agent' => $agent,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Agent entity.
     *
     */
    public function deleteAction(Request $request, Agent $agent)
    {
        $form = $this->createDeleteForm($agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($agent);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'agent.delete.flash' );
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
