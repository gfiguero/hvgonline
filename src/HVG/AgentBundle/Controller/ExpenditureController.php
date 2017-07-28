<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Expenditure;
use HVG\SystemBundle\Form\ExpenditureType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Expenditure controller.
 *
 */
class ExpenditureController extends Controller
{

    /**
     * Lists all Expenditure entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $expenditures = $em->getRepository('HVGSystemBundle:Expenditure')->findBy(array(), array($sort => $direction));
        else $expenditures = $em->getRepository('HVGSystemBundle:Expenditure')->findAll();
        $paginator = $this->get('knp_paginator');
        $expenditures = $paginator->paginate($expenditures, $request->query->getInt('page', 1), 100);

        return $this->render('HVGAgentBundle:Expenditure:index.html.twig', array(
            'expenditures' => $expenditures,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function newAction(Request $request)
    {
        $expenditure = new Expenditure();
        $newForm = $this->createNewForm($expenditure);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($expenditure);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'expenditure.new.flash' );
                return $this->redirect($this->generateUrl('agent_expenditure_show', array('id' => $expenditure->getId())));
            }
        }

        return $this->render('HVGAgentBundle:Expenditure:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    public function editAction(Request $request, Expenditure $expenditure)
    {
        $editForm = $this->createEditForm($expenditure);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($expenditure);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'expenditure.edit.flash' );
                return $this->redirect($this->generateUrl('agent_expenditure_index'));
            }
        }

        return $this->render('HVGAgentBundle:Expenditure:edit.html.twig', array(
            'expenditure' => $expenditure,
            'editForm' => $editForm->createView(),
        ));
    }

    /**
     * Finds and displays a Expenditure entity.
     *
     */
    public function showAction(Expenditure $expenditure)
    {
        return $this->render('HVGAgentBundle:Expenditure:show.html.twig', array(
            'expenditure' => $expenditure,
        ));
    }

    private function createNewForm(Expenditure $expenditure)
    {
        return $this->createForm('HVG\AgentBundle\Form\ExpenditureType', $expenditure, array(
            'action' => $this->generateUrl('agent_expenditure_new'),
        ));
    }

    private function createEditForm(Expenditure $expenditure)
    {
        return $this->createForm('HVG\AgentBundle\Form\ExpenditureType', $expenditure, array(
            'action' => $this->generateUrl('agent_expenditure_edit', array('id' => $expenditure->getId())),
        ));
    }

}
