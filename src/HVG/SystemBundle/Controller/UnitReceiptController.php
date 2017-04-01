<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\UnitReceipt;
use HVG\SystemBundle\Form\UnitReceiptType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Unitreceipt controller.
 *
 */
class UnitReceiptController extends Controller
{

    /**
     * Lists all UnitReceipt entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $unitReceipts = $em->getRepository('HVGSystemBundle:UnitReceipt')->findBy(array(), array($sort => $direction));
        else $unitReceipts = $em->getRepository('HVGSystemBundle:UnitReceipt')->findAll();
        $paginator = $this->get('knp_paginator');
        $unitReceipts = $paginator->paginate($unitReceipts, $request->query->getInt('page', 1), 30);
        $unitReceipt = new UnitReceipt();
        $newForm = $this->createNewForm($unitReceipt)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($unitReceipts as $key => $unitReceipt) {
            $editForms[] = $this->createEditForm($unitReceipt)->createView();
            $deleteForms[] = $this->createDeleteForm($unitReceipt)->createView();
        }

        return $this->render('unitreceipt/index.html.twig', array(
            'unitReceipts' => $unitReceipts,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new UnitReceipt entity.
     *
     */
    public function newAction(Request $request)
    {
        $unitReceipt = new UnitReceipt();
        $newForm = $this->createNewForm($unitReceipt);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($unitReceipt);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'unitReceipt.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new UnitReceipt entity.
     *
     * @param UnitReceipt $unitReceipt The UnitReceipt entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(UnitReceipt $unitReceipt)
    {
        return $this->createForm('HVG\SystemBundle\Form\UnitReceiptType', $unitReceipt, array(
            'action' => $this->generateUrl('unitreceipt_new'),
        ));
    }

    /**
     * Finds and displays a UnitReceipt entity.
     *
     */
    public function showAction(UnitReceipt $unitReceipt)
    {
        $editForm = $this->createEditForm($unitReceipt);
        $deleteForm = $this->createDeleteForm($unitReceipt);

        return $this->render('unitreceipt/show.html.twig', array(
            'unitReceipt' => $unitReceipt,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing UnitReceipt entity.
     *
     */
    public function editAction(Request $request, UnitReceipt $unitReceipt)
    {
        $editForm = $this->createEditForm($unitReceipt);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($unitReceipt);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'unitReceipt.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a UnitReceipt entity.
     *
     * @param UnitReceipt $unitReceipt The UnitReceipt entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(UnitReceipt $unitReceipt)
    {
        return $this->createForm('HVG\SystemBundle\Form\UnitReceiptType', $unitReceipt, array(
            'action' => $this->generateUrl('unitreceipt_edit', array('id' => $unitReceipt->getId())),
        ));
    }

    /**
     * Deletes a UnitReceipt entity.
     *
     */
    public function deleteAction(Request $request, UnitReceipt $unitReceipt)
    {
        $deleteForm = $this->createDeleteForm($unitReceipt);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($unitReceipt);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'unitReceipt.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a UnitReceipt entity.
     *
     * @param UnitReceipt $unitReceipt The UnitReceipt entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UnitReceipt $unitReceipt)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('unitreceipt_delete', array('id' => $unitReceipt->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
