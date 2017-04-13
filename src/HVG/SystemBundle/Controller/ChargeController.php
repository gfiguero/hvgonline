<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Charge;
use HVG\SystemBundle\Form\ChargeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Charge controller.
 *
 */
class ChargeController extends Controller
{

    /**
     * Lists all Charge entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $charges = $em->getRepository('HVGSystemBundle:Charge')->findBy(array(), array($sort => $direction));
        else $charges = $em->getRepository('HVGSystemBundle:Charge')->findAll();
        $paginator = $this->get('knp_paginator');
        $charges = $paginator->paginate($charges, $request->query->getInt('page', 1), 100);
        $charge = new Charge();
        $newForm = $this->createNewForm($charge)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($charges as $key => $charge) {
            $editForms[] = $this->createEditForm($charge)->createView();
            $deleteForms[] = $this->createDeleteForm($charge)->createView();
        }

        return $this->render('charge/index.html.twig', array(
            'charges' => $charges,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Charge entity.
     *
     */
    public function newAction(Request $request)
    {
        $charge = new Charge();
        $newForm = $this->createNewForm($charge);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($charge);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'charge.flash.created' );
            } else {
                return $this->render('charge/new.html.twig', array(
                    'charge' => $charge,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('charge_index'));
    }

    /**
     * Creates a form to create a new Charge entity.
     *
     * @param Charge $charge The Charge entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Charge $charge)
    {
        return $this->createForm('HVG\SystemBundle\Form\ChargeType', $charge, array(
            'action' => $this->generateUrl('charge_new'),
        ));
    }

    /**
     * Finds and displays a Charge entity.
     *
     */
    public function showAction(Charge $charge)
    {
        $editForm = $this->createEditForm($charge);
        $deleteForm = $this->createDeleteForm($charge);

        return $this->render('charge/show.html.twig', array(
            'charge' => $charge,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Charge entity.
     *
     */
    public function editAction(Request $request, Charge $charge)
    {
        $editForm = $this->createEditForm($charge);
        $deleteForm = $this->createDeleteForm($charge);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($charge);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'charge.flash.updated' );
            } else {
                return $this->render('charge/edit.html.twig', array(
                    'charge' => $charge,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('charge_index'));
    }

    /**
     * Creates a form to edit a Charge entity.
     *
     * @param Charge $charge The Charge entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Charge $charge)
    {
        return $this->createForm('HVG\SystemBundle\Form\ChargeType', $charge, array(
            'action' => $this->generateUrl('charge_edit', array('id' => $charge->getId())),
        ));
    }

    /**
     * Deletes a Charge entity.
     *
     */
    public function deleteAction(Request $request, Charge $charge)
    {
        $deleteForm = $this->createDeleteForm($charge);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($charge);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'charge.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('charge_index'));
    }

    /**
     * Creates a form to delete a Charge entity.
     *
     * @param Charge $charge The Charge entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Charge $charge)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('charge_delete', array('id' => $charge->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
