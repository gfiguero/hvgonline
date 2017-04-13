<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\TicketAction;
use HVG\SystemBundle\Form\TicketActionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Ticketaction controller.
 *
 */
class TicketActionController extends Controller
{

    /**
     * Lists all TicketAction entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $ticketActions = $em->getRepository('HVGSystemBundle:TicketAction')->findBy(array(), array($sort => $direction));
        else $ticketActions = $em->getRepository('HVGSystemBundle:TicketAction')->findAll();
        $paginator = $this->get('knp_paginator');
        $ticketActions = $paginator->paginate($ticketActions, $request->query->getInt('page', 1), 100);
        $ticketAction = new TicketAction();
        $newForm = $this->createNewForm($ticketAction)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($ticketActions as $key => $ticketAction) {
            $editForms[] = $this->createEditForm($ticketAction)->createView();
            $deleteForms[] = $this->createDeleteForm($ticketAction)->createView();
        }

        return $this->render('ticketaction/index.html.twig', array(
            'ticketActions' => $ticketActions,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new TicketAction entity.
     *
     */
    public function newAction(Request $request)
    {
        $ticketAction = new TicketAction();
        $newForm = $this->createNewForm($ticketAction);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($ticketAction);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'ticketAction.flash.created' );
            } else {
                return $this->render('ticketaction/new.html.twig', array(
                    'ticketAction' => $ticketAction,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('ticketaction_index'));
    }

    /**
     * Creates a form to create a new TicketAction entity.
     *
     * @param TicketAction $ticketAction The TicketAction entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(TicketAction $ticketAction)
    {
        return $this->createForm('HVG\SystemBundle\Form\TicketActionType', $ticketAction, array(
            'action' => $this->generateUrl('ticketaction_new'),
        ));
    }

    /**
     * Finds and displays a TicketAction entity.
     *
     */
    public function showAction(TicketAction $ticketAction)
    {
        $editForm = $this->createEditForm($ticketAction);
        $deleteForm = $this->createDeleteForm($ticketAction);

        return $this->render('ticketaction/show.html.twig', array(
            'ticketAction' => $ticketAction,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TicketAction entity.
     *
     */
    public function editAction(Request $request, TicketAction $ticketAction)
    {
        $editForm = $this->createEditForm($ticketAction);
        $deleteForm = $this->createDeleteForm($ticketAction);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($ticketAction);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'ticketAction.flash.updated' );
            } else {
                return $this->render('ticketaction/edit.html.twig', array(
                    'ticketAction' => $ticketAction,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('ticketaction_index'));
    }

    /**
     * Creates a form to edit a TicketAction entity.
     *
     * @param TicketAction $ticketAction The TicketAction entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(TicketAction $ticketAction)
    {
        return $this->createForm('HVG\SystemBundle\Form\TicketActionType', $ticketAction, array(
            'action' => $this->generateUrl('ticketaction_edit', array('id' => $ticketAction->getId())),
        ));
    }

    /**
     * Deletes a TicketAction entity.
     *
     */
    public function deleteAction(Request $request, TicketAction $ticketAction)
    {
        $deleteForm = $this->createDeleteForm($ticketAction);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ticketAction);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'ticketAction.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('ticketaction_index'));
    }

    /**
     * Creates a form to delete a TicketAction entity.
     *
     * @param TicketAction $ticketAction The TicketAction entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TicketAction $ticketAction)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ticketaction_delete', array('id' => $ticketAction->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
