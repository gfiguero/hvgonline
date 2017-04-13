<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\AllowanceCharge;
use HVG\SystemBundle\Form\AllowanceChargeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Allowancecharge controller.
 *
 */
class AllowanceChargeController extends Controller
{

    /**
     * Lists all AllowanceCharge entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $allowanceCharges = $em->getRepository('HVGSystemBundle:AllowanceCharge')->findBy(array(), array($sort => $direction));
        else $allowanceCharges = $em->getRepository('HVGSystemBundle:AllowanceCharge')->findAll();
        $paginator = $this->get('knp_paginator');
        $allowanceCharges = $paginator->paginate($allowanceCharges, $request->query->getInt('page', 1), 100);
        $allowanceCharge = new AllowanceCharge();
        $newForm = $this->createNewForm($allowanceCharge)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($allowanceCharges as $key => $allowanceCharge) {
            $editForms[] = $this->createEditForm($allowanceCharge)->createView();
            $deleteForms[] = $this->createDeleteForm($allowanceCharge)->createView();
        }

        return $this->render('allowancecharge/index.html.twig', array(
            'allowanceCharges' => $allowanceCharges,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new AllowanceCharge entity.
     *
     */
    public function newAction(Request $request)
    {
        $allowanceCharge = new AllowanceCharge();
        $newForm = $this->createNewForm($allowanceCharge);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($allowanceCharge);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'allowanceCharge.flash.created' );
            } else {
                return $this->render('allowancecharge/new.html.twig', array(
                    'allowanceCharge' => $allowanceCharge,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('allowancecharge_index'));
    }

    /**
     * Creates a form to create a new AllowanceCharge entity.
     *
     * @param AllowanceCharge $allowanceCharge The AllowanceCharge entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(AllowanceCharge $allowanceCharge)
    {
        return $this->createForm('HVG\SystemBundle\Form\AllowanceChargeType', $allowanceCharge, array(
            'action' => $this->generateUrl('allowancecharge_new'),
        ));
    }

    /**
     * Finds and displays a AllowanceCharge entity.
     *
     */
    public function showAction(AllowanceCharge $allowanceCharge)
    {
        $editForm = $this->createEditForm($allowanceCharge);
        $deleteForm = $this->createDeleteForm($allowanceCharge);

        return $this->render('allowancecharge/show.html.twig', array(
            'allowanceCharge' => $allowanceCharge,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing AllowanceCharge entity.
     *
     */
    public function editAction(Request $request, AllowanceCharge $allowanceCharge)
    {
        $editForm = $this->createEditForm($allowanceCharge);
        $deleteForm = $this->createDeleteForm($allowanceCharge);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($allowanceCharge);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'allowanceCharge.flash.updated' );
            } else {
                return $this->render('allowancecharge/edit.html.twig', array(
                    'allowanceCharge' => $allowanceCharge,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('allowancecharge_index'));
    }

    /**
     * Creates a form to edit a AllowanceCharge entity.
     *
     * @param AllowanceCharge $allowanceCharge The AllowanceCharge entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(AllowanceCharge $allowanceCharge)
    {
        return $this->createForm('HVG\SystemBundle\Form\AllowanceChargeType', $allowanceCharge, array(
            'action' => $this->generateUrl('allowancecharge_edit', array('id' => $allowanceCharge->getId())),
        ));
    }

    /**
     * Deletes a AllowanceCharge entity.
     *
     */
    public function deleteAction(Request $request, AllowanceCharge $allowanceCharge)
    {
        $deleteForm = $this->createDeleteForm($allowanceCharge);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($allowanceCharge);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'allowanceCharge.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('allowancecharge_index'));
    }

    /**
     * Creates a form to delete a AllowanceCharge entity.
     *
     * @param AllowanceCharge $allowanceCharge The AllowanceCharge entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AllowanceCharge $allowanceCharge)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('allowancecharge_delete', array('id' => $allowanceCharge->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
