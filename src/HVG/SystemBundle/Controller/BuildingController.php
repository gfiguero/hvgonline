<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Building;
use HVG\SystemBundle\Form\BuildingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Building controller.
 *
 */
class BuildingController extends Controller
{

    /**
     * Lists all Building entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $buildings = $em->getRepository('HVGSystemBundle:Building')->findBy(array(), array($sort => $direction));
        else $buildings = $em->getRepository('HVGSystemBundle:Building')->findAll();
        $paginator = $this->get('knp_paginator');
        $buildings = $paginator->paginate($buildings, $request->query->getInt('page', 1), 100);
        $building = new Building();
        $newForm = $this->createNewForm($building)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($buildings as $key => $building) {
            $editForms[] = $this->createEditForm($building)->createView();
            $deleteForms[] = $this->createDeleteForm($building)->createView();
        }

        return $this->render('building/index.html.twig', array(
            'buildings' => $buildings,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Building entity.
     *
     */
    public function newAction(Request $request)
    {
        $building = new Building();
        $newForm = $this->createNewForm($building);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($building);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'building.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new Building entity.
     *
     * @param Building $building The Building entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Building $building)
    {
        return $this->createForm('HVG\SystemBundle\Form\BuildingType', $building, array(
            'action' => $this->generateUrl('building_new'),
        ));
    }

    /**
     * Finds and displays a Building entity.
     *
     */
    public function showAction(Building $building)
    {
        $editForm = $this->createEditForm($building);
        $deleteForm = $this->createDeleteForm($building);

        return $this->render('building/show.html.twig', array(
            'building' => $building,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Building entity.
     *
     */
    public function editAction(Request $request, Building $building)
    {
        $editForm = $this->createEditForm($building);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($building);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'building.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a Building entity.
     *
     * @param Building $building The Building entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Building $building)
    {
        return $this->createForm('HVG\SystemBundle\Form\BuildingType', $building, array(
            'action' => $this->generateUrl('building_edit', array('id' => $building->getId())),
        ));
    }

    /**
     * Deletes a Building entity.
     *
     */
    public function deleteAction(Request $request, Building $building)
    {
        $deleteForm = $this->createDeleteForm($building);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($building);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'building.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a Building entity.
     *
     * @param Building $building The Building entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Building $building)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('building_delete', array('id' => $building->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
