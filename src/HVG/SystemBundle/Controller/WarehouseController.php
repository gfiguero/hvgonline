<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Warehouse;
use HVG\SystemBundle\Form\WarehouseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Warehouse controller.
 *
 */
class WarehouseController extends Controller
{

    /**
     * Lists all Warehouse entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $warehouses = $em->getRepository('HVGSystemBundle:Warehouse')->findBy(array(), array($sort => $direction));
        else $warehouses = $em->getRepository('HVGSystemBundle:Warehouse')->findAll();
        $paginator = $this->get('knp_paginator');
        $warehouses = $paginator->paginate($warehouses, $request->query->getInt('page', 1), 100);
        $warehouse = new Warehouse();
        $newForm = $this->createNewForm($warehouse)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($warehouses as $key => $warehouse) {
            $editForms[] = $this->createEditForm($warehouse)->createView();
            $deleteForms[] = $this->createDeleteForm($warehouse)->createView();
        }

        return $this->render('warehouse/index.html.twig', array(
            'warehouses' => $warehouses,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Warehouse entity.
     *
     */
    public function newAction(Request $request)
    {
        $warehouse = new Warehouse();
        $newForm = $this->createNewForm($warehouse);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($warehouse);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'warehouse.flash.created' );
            } else {
                return $this->render('warehouse/new.html.twig', array(
                    'warehouse' => $warehouse,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('warehouse_index'));
    }

    /**
     * Creates a form to create a new Warehouse entity.
     *
     * @param Warehouse $warehouse The Warehouse entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Warehouse $warehouse)
    {
        return $this->createForm('HVG\SystemBundle\Form\WarehouseType', $warehouse, array(
            'action' => $this->generateUrl('warehouse_new'),
        ));
    }

    /**
     * Finds and displays a Warehouse entity.
     *
     */
    public function showAction(Warehouse $warehouse)
    {
        $editForm = $this->createEditForm($warehouse);
        $deleteForm = $this->createDeleteForm($warehouse);

        return $this->render('warehouse/show.html.twig', array(
            'warehouse' => $warehouse,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Warehouse entity.
     *
     */
    public function editAction(Request $request, Warehouse $warehouse)
    {
        $editForm = $this->createEditForm($warehouse);
        $deleteForm = $this->createDeleteForm($warehouse);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($warehouse);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'warehouse.flash.updated' );
            } else {
                return $this->render('warehouse/edit.html.twig', array(
                    'warehouse' => $warehouse,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('warehouse_index'));
    }

    /**
     * Creates a form to edit a Warehouse entity.
     *
     * @param Warehouse $warehouse The Warehouse entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Warehouse $warehouse)
    {
        return $this->createForm('HVG\SystemBundle\Form\WarehouseType', $warehouse, array(
            'action' => $this->generateUrl('warehouse_edit', array('id' => $warehouse->getId())),
        ));
    }

    /**
     * Deletes a Warehouse entity.
     *
     */
    public function deleteAction(Request $request, Warehouse $warehouse)
    {
        $deleteForm = $this->createDeleteForm($warehouse);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($warehouse);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'warehouse.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('warehouse_index'));
    }

    /**
     * Creates a form to delete a Warehouse entity.
     *
     * @param Warehouse $warehouse The Warehouse entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Warehouse $warehouse)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('warehouse_delete', array('id' => $warehouse->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
