<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Vehicle;
use HVG\SystemBundle\Form\VehicleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Vehicle controller.
 *
 */
class VehicleController extends Controller
{

    /**
     * Lists all Vehicle entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $vehicles = $em->getRepository('HVGSystemBundle:Vehicle')->findBy(array(), array($sort => $direction));
        else $vehicles = $em->getRepository('HVGSystemBundle:Vehicle')->findAll();
        $paginator = $this->get('knp_paginator');
        $vehicles = $paginator->paginate($vehicles, $request->query->getInt('page', 1), 100);
        $vehicle = new Vehicle();
        $newForm = $this->createNewForm($vehicle)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($vehicles as $key => $vehicle) {
            $editForms[] = $this->createEditForm($vehicle)->createView();
            $deleteForms[] = $this->createDeleteForm($vehicle)->createView();
        }

        return $this->render('vehicle/index.html.twig', array(
            'vehicles' => $vehicles,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Vehicle entity.
     *
     */
    public function newAction(Request $request)
    {
        $vehicle = new Vehicle();
        $newForm = $this->createNewForm($vehicle);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($vehicle);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'vehicle.flash.created' );
            } else {
                return $this->render('vehicle/new.html.twig', array(
                    'vehicle' => $vehicle,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('vehicle_index'));
    }

    /**
     * Creates a form to create a new Vehicle entity.
     *
     * @param Vehicle $vehicle The Vehicle entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Vehicle $vehicle)
    {
        return $this->createForm('HVG\SystemBundle\Form\VehicleType', $vehicle, array(
            'action' => $this->generateUrl('vehicle_new'),
        ));
    }

    /**
     * Finds and displays a Vehicle entity.
     *
     */
    public function showAction(Vehicle $vehicle)
    {
        $editForm = $this->createEditForm($vehicle);
        $deleteForm = $this->createDeleteForm($vehicle);

        return $this->render('vehicle/show.html.twig', array(
            'vehicle' => $vehicle,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Vehicle entity.
     *
     */
    public function editAction(Request $request, Vehicle $vehicle)
    {
        $editForm = $this->createEditForm($vehicle);
        $deleteForm = $this->createDeleteForm($vehicle);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($vehicle);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'vehicle.flash.updated' );
            } else {
                return $this->render('vehicle/edit.html.twig', array(
                    'vehicle' => $vehicle,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('vehicle_index'));
    }

    /**
     * Creates a form to edit a Vehicle entity.
     *
     * @param Vehicle $vehicle The Vehicle entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Vehicle $vehicle)
    {
        return $this->createForm('HVG\SystemBundle\Form\VehicleType', $vehicle, array(
            'action' => $this->generateUrl('vehicle_edit', array('id' => $vehicle->getId())),
        ));
    }

    /**
     * Deletes a Vehicle entity.
     *
     */
    public function deleteAction(Request $request, Vehicle $vehicle)
    {
        $deleteForm = $this->createDeleteForm($vehicle);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($vehicle);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'vehicle.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('vehicle_index'));
    }

    /**
     * Creates a form to delete a Vehicle entity.
     *
     * @param Vehicle $vehicle The Vehicle entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Vehicle $vehicle)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vehicle_delete', array('id' => $vehicle->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
