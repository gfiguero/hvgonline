<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\BankAccountKind;
use HVG\SystemBundle\Form\BankAccountKindType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Bankaccountkind controller.
 *
 */
class BankAccountKindController extends Controller
{

    /**
     * Lists all BankAccountKind entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $bankAccountKinds = $em->getRepository('HVGSystemBundle:BankAccountKind')->findBy(array(), array($sort => $direction));
        else $bankAccountKinds = $em->getRepository('HVGSystemBundle:BankAccountKind')->findAll();
        $paginator = $this->get('knp_paginator');
        $bankAccountKinds = $paginator->paginate($bankAccountKinds, $request->query->getInt('page', 1), 100);
        $bankAccountKind = new BankAccountKind();
        $newForm = $this->createNewForm($bankAccountKind)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($bankAccountKinds as $key => $bankAccountKind) {
            $editForms[] = $this->createEditForm($bankAccountKind)->createView();
            $deleteForms[] = $this->createDeleteForm($bankAccountKind)->createView();
        }

        return $this->render('bankaccountkind/index.html.twig', array(
            'bankAccountKinds' => $bankAccountKinds,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new BankAccountKind entity.
     *
     */
    public function newAction(Request $request)
    {
        $bankAccountKind = new BankAccountKind();
        $newForm = $this->createNewForm($bankAccountKind);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bankAccountKind);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'bankAccountKind.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new BankAccountKind entity.
     *
     * @param BankAccountKind $bankAccountKind The BankAccountKind entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(BankAccountKind $bankAccountKind)
    {
        return $this->createForm('HVG\SystemBundle\Form\BankAccountKindType', $bankAccountKind, array(
            'action' => $this->generateUrl('bankaccountkind_new'),
        ));
    }

    /**
     * Finds and displays a BankAccountKind entity.
     *
     */
    public function showAction(BankAccountKind $bankAccountKind)
    {
        $editForm = $this->createEditForm($bankAccountKind);
        $deleteForm = $this->createDeleteForm($bankAccountKind);

        return $this->render('bankaccountkind/show.html.twig', array(
            'bankAccountKind' => $bankAccountKind,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing BankAccountKind entity.
     *
     */
    public function editAction(Request $request, BankAccountKind $bankAccountKind)
    {
        $editForm = $this->createEditForm($bankAccountKind);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bankAccountKind);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'bankAccountKind.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a BankAccountKind entity.
     *
     * @param BankAccountKind $bankAccountKind The BankAccountKind entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(BankAccountKind $bankAccountKind)
    {
        return $this->createForm('HVG\SystemBundle\Form\BankAccountKindType', $bankAccountKind, array(
            'action' => $this->generateUrl('bankaccountkind_edit', array('id' => $bankAccountKind->getId())),
        ));
    }

    /**
     * Deletes a BankAccountKind entity.
     *
     */
    public function deleteAction(Request $request, BankAccountKind $bankAccountKind)
    {
        $deleteForm = $this->createDeleteForm($bankAccountKind);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bankAccountKind);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'bankAccountKind.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a BankAccountKind entity.
     *
     * @param BankAccountKind $bankAccountKind The BankAccountKind entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BankAccountKind $bankAccountKind)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bankaccountkind_delete', array('id' => $bankAccountKind->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
