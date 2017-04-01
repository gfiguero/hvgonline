<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\UnitPayment;
use HVG\SystemBundle\Form\UnitPaymentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Unitpayment controller.
 *
 */
class UnitPaymentController extends Controller
{

    /**
     * Lists all UnitPayment entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $unitPayments = $em->getRepository('HVGSystemBundle:UnitPayment')->findBy(array(), array($sort => $direction));
        else $unitPayments = $em->getRepository('HVGSystemBundle:UnitPayment')->findAll();
        $paginator = $this->get('knp_paginator');
        $unitPayments = $paginator->paginate($unitPayments, $request->query->getInt('page', 1), 30);
        $unitPayment = new UnitPayment();
        $newForm = $this->createNewForm($unitPayment)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($unitPayments as $key => $unitPayment) {
            $editForms[] = $this->createEditForm($unitPayment)->createView();
            $deleteForms[] = $this->createDeleteForm($unitPayment)->createView();
        }

        return $this->render('unitpayment/index.html.twig', array(
            'unitPayments' => $unitPayments,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new UnitPayment entity.
     *
     */
    public function newAction(Request $request)
    {
        $unitPayment = new UnitPayment();
        $newForm = $this->createNewForm($unitPayment);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($unitPayment);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'unitPayment.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new UnitPayment entity.
     *
     * @param UnitPayment $unitPayment The UnitPayment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(UnitPayment $unitPayment)
    {
        return $this->createForm('HVG\SystemBundle\Form\UnitPaymentType', $unitPayment, array(
            'action' => $this->generateUrl('unitpayment_new'),
        ));
    }

    /**
     * Finds and displays a UnitPayment entity.
     *
     */
    public function showAction(UnitPayment $unitPayment)
    {
        $editForm = $this->createEditForm($unitPayment);
        $deleteForm = $this->createDeleteForm($unitPayment);

        return $this->render('unitpayment/show.html.twig', array(
            'unitPayment' => $unitPayment,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing UnitPayment entity.
     *
     */
    public function editAction(Request $request, UnitPayment $unitPayment)
    {
        $editForm = $this->createEditForm($unitPayment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($unitPayment);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'unitPayment.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a UnitPayment entity.
     *
     * @param UnitPayment $unitPayment The UnitPayment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(UnitPayment $unitPayment)
    {
        return $this->createForm('HVG\SystemBundle\Form\UnitPaymentType', $unitPayment, array(
            'action' => $this->generateUrl('unitpayment_edit', array('id' => $unitPayment->getId())),
        ));
    }

    /**
     * Deletes a UnitPayment entity.
     *
     */
    public function deleteAction(Request $request, UnitPayment $unitPayment)
    {
        $deleteForm = $this->createDeleteForm($unitPayment);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($unitPayment);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'unitPayment.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a UnitPayment entity.
     *
     * @param UnitPayment $unitPayment The UnitPayment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UnitPayment $unitPayment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('unitpayment_delete', array('id' => $unitPayment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
