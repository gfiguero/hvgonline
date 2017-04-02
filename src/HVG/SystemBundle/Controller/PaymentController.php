<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Payment;
use HVG\SystemBundle\Form\PaymentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Payment controller.
 *
 */
class PaymentController extends Controller
{

    /**
     * Lists all Payment entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $payments = $em->getRepository('HVGSystemBundle:Payment')->findBy(array(), array($sort => $direction));
        else $payments = $em->getRepository('HVGSystemBundle:Payment')->findAll();
        $paginator = $this->get('knp_paginator');
        $payments = $paginator->paginate($payments, $request->query->getInt('page', 1), 100);
        $payment = new Payment();
        $newForm = $this->createNewForm($payment)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($payments as $key => $payment) {
            $editForms[] = $this->createEditForm($payment)->createView();
            $deleteForms[] = $this->createDeleteForm($payment)->createView();
        }

        return $this->render('payment/index.html.twig', array(
            'payments' => $payments,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Payment entity.
     *
     */
    public function newAction(Request $request)
    {
        $payment = new Payment();
        $newForm = $this->createNewForm($payment);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($payment);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'payment.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new Payment entity.
     *
     * @param Payment $payment The Payment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Payment $payment)
    {
        return $this->createForm('HVG\SystemBundle\Form\PaymentType', $payment, array(
            'action' => $this->generateUrl('payment_new'),
        ));
    }

    /**
     * Finds and displays a Payment entity.
     *
     */
    public function showAction(Payment $payment)
    {
        $editForm = $this->createEditForm($payment);
        $deleteForm = $this->createDeleteForm($payment);

        return $this->render('payment/show.html.twig', array(
            'payment' => $payment,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Payment entity.
     *
     */
    public function editAction(Request $request, Payment $payment)
    {
        $editForm = $this->createEditForm($payment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($payment);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'payment.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a Payment entity.
     *
     * @param Payment $payment The Payment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Payment $payment)
    {
        return $this->createForm('HVG\SystemBundle\Form\PaymentType', $payment, array(
            'action' => $this->generateUrl('payment_edit', array('id' => $payment->getId())),
        ));
    }

    /**
     * Deletes a Payment entity.
     *
     */
    public function deleteAction(Request $request, Payment $payment)
    {
        $deleteForm = $this->createDeleteForm($payment);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($payment);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'payment.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a Payment entity.
     *
     * @param Payment $payment The Payment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Payment $payment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('payment_delete', array('id' => $payment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
