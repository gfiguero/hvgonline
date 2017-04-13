<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Form\UnitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Unit controller.
 *
 */
class UnitController extends Controller
{

    /**
     * Lists all Unit entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $units = $em->getRepository('HVGSystemBundle:Unit')->findBy(array(), array($sort => $direction));
        else $units = $em->getRepository('HVGSystemBundle:Unit')->findAll();
        $paginator = $this->get('knp_paginator');
        $units = $paginator->paginate($units, $request->query->getInt('page', 1), 100);
        $unit = new Unit();
        $newForm = $this->createNewForm($unit)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($units as $key => $unit) {
            $editForms[] = $this->createEditForm($unit)->createView();
            $deleteForms[] = $this->createDeleteForm($unit)->createView();
        }

        return $this->render('unit/index.html.twig', array(
            'units' => $units,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Unit entity.
     *
     */
    public function newAction(Request $request)
    {
        $unit = new Unit();
        $newForm = $this->createNewForm($unit);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($unit);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'unit.flash.created' );
            } else {
                return $this->render('unit/new.html.twig', array(
                    'unit' => $unit,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('unit_index'));
    }

    /**
     * Creates a form to create a new Unit entity.
     *
     * @param Unit $unit The Unit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Unit $unit)
    {
        return $this->createForm('HVG\SystemBundle\Form\UnitType', $unit, array(
            'action' => $this->generateUrl('unit_new'),
        ));
    }

    /**
     * Finds and displays a Unit entity.
     *
     */
    public function showAction(Unit $unit)
    {
        $editForm = $this->createEditForm($unit);
        $deleteForm = $this->createDeleteForm($unit);

        return $this->render('unit/show.html.twig', array(
            'unit' => $unit,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Unit entity.
     *
     */
    public function editAction(Request $request, Unit $unit)
    {
        $editForm = $this->createEditForm($unit);
        $deleteForm = $this->createDeleteForm($unit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($unit);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'unit.flash.updated' );
            } else {
                return $this->render('unit/edit.html.twig', array(
                    'unit' => $unit,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('unit_index'));
    }

    /**
     * Creates a form to edit a Unit entity.
     *
     * @param Unit $unit The Unit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Unit $unit)
    {
        return $this->createForm('HVG\SystemBundle\Form\UnitType', $unit, array(
            'action' => $this->generateUrl('unit_edit', array('id' => $unit->getId())),
        ));
    }

    /**
     * Deletes a Unit entity.
     *
     */
    public function deleteAction(Request $request, Unit $unit)
    {
        $deleteForm = $this->createDeleteForm($unit);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($unit);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'unit.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('unit_index'));
    }

    /**
     * Creates a form to delete a Unit entity.
     *
     * @param Unit $unit The Unit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Unit $unit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('unit_delete', array('id' => $unit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
