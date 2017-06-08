<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Outflow;
use HVG\SystemBundle\Form\OutflowType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Outflow controller.
 *
 */
class OutflowController extends Controller
{

    /**
     * Lists all Outflow entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $outflows = $em->getRepository('HVGSystemBundle:Outflow')->findBy(array(), array($sort => $direction));
        else $outflows = $em->getRepository('HVGSystemBundle:Outflow')->findAll();
        $paginator = $this->get('knp_paginator');
        $outflows = $paginator->paginate($outflows, $request->query->getInt('page', 1), 100);

        return $this->render('HVGAgentBundle:Outflow:index.html.twig', array(
            'outflows' => $outflows,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function newAction(Request $request)
    {
        $outflow = new Outflow();
        $newForm = $this->createNewForm($outflow);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($outflow);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'outflow.new.flash' );
                return $this->redirect($this->generateUrl('agent_outflow_show', array('id' => $outflow->getId())));
            }
        }

        return $this->render('HVGAgentBundle:Outflow:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Finds and displays a Outflow entity.
     *
     */
    public function showAction(Outflow $outflow)
    {
        return $this->render('HVGAgentBundle:Outflow:show.html.twig', array(
            'outflow' => $outflow,
        ));
    }

    private function createNewForm(Outflow $outflow)
    {
        return $this->createForm('HVG\AgentBundle\Form\OutflowType', $outflow, array(
            'action' => $this->generateUrl('agent_outflow_new'),
        ));
    }

}
