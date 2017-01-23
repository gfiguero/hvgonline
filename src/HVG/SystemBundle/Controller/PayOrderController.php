<?php

namespace HVG\SystemBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HVG\SystemBundle\Entity\PayOrder;
use HVG\SystemBundle\Form\PayOrderType;

class PayOrderController extends Controller
{
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $payOrders = $em->getRepository('HVGSystemBundle:PayOrder')->findBy(array(), array($sort => $direction));
        else $payOrders = $em->getRepository('HVGSystemBundle:PayOrder')->findAll();
        $paginator = $this->get('knp_paginator');
        $payOrders = $paginator->paginate($payOrders, $request->query->getInt('page', 1), 24);

        $deleteForms = array();
        $editForms = array();
        $payOrder = new PayOrder();
        $newForm = $this->createForm('HVG\SystemBundle\Form\PayOrderType', $payOrder, array(
            'action' => $this->generateUrl('pay_order_new'),
        ))->createView();

        foreach ($payOrders as $key => $payOrder) {
            $editForms[] = $this->createForm('HVG\SystemBundle\Form\PayOrderType', $payOrder, array(
                'action' => $this->generateUrl('pay_order_edit', array('id' => $payOrder->getId())),
            ))->createView();
            $deleteForms[] = $this->createDeleteForm($payOrder, array(
                'action' => $this->generateUrl('pay_order_delete', array('id' => $payOrder->getId())),
            ))->createView();
        }

        return $this->render('HVGSystemBundle:PayOrder:index.html.twig', array(
            'payOrders' => $payOrders,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new PayOrder entity.
     *
     */
    public function newAction(Request $request)
    {
        $payOrder = new PayOrder();
        $form = $this->createForm('HVG\SystemBundle\Form\PayOrderType', $payOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($payOrder);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'payOrder.new.flash' );

        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Displays a form to edit an existing PayOrder entity.
     *
     */
    public function editAction(Request $request, PayOrder $payOrder)
    {
        $deleteForm = $this->createDeleteForm($payOrder);
        $editForm = $this->createForm('HVG\SystemBundle\Form\PayOrderType', $payOrder);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($payOrder);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'payOrder.edit.flash' );

            return $this->redirect($request->headers->get('referer'));
        }

        return $this->render('payOrder/edit.html.twig', array(
            'payOrder' => $payOrder,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a PayOrder entity.
     *
     */
    public function deleteAction(Request $request, PayOrder $payOrder)
    {
        $form = $this->createDeleteForm($payOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($payOrder);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'payOrder.delete.flash' );
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a PayOrder entity.
     *
     * @param PayOrder $payOrder The PayOrder entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PayOrder $payOrder)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pay_order_delete', array('id' => $payOrder->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
