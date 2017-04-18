<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Form\UnitGroupType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Unitgroup controller.
 *
 */
class UnitGroupController extends Controller
{

    /**
     * Lists all UnitGroup entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $unitGroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findBy(array(), array($sort => $direction));
        else $unitGroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findAll();
        $paginator = $this->get('knp_paginator');
        $unitGroups = $paginator->paginate($unitGroups, $request->query->getInt('page', 1), 100);
        $unitGroup = new UnitGroup();
        $newForm = $this->createNewForm($unitGroup)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($unitGroups as $key => $unitGroup) {
            $editForms[] = $this->createEditForm($unitGroup)->createView();
            $deleteForms[] = $this->createDeleteForm($unitGroup)->createView();
        }

        return $this->render('unitgroup/index.html.twig', array(
            'unitGroups' => $unitGroups,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new UnitGroup entity.
     *
     */
    public function newAction(Request $request)
    {
        $unitGroup = new UnitGroup();
        $newForm = $this->createNewForm($unitGroup);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($unitGroup);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'unitGroup.flash.created' );
            } else {
                return $this->render('unitgroup/new.html.twig', array(
                    'unitGroup' => $unitGroup,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('unitgroup_index'));
    }

    /**
     * Creates a form to create a new UnitGroup entity.
     *
     * @param UnitGroup $unitGroup The UnitGroup entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(UnitGroup $unitGroup)
    {
        return $this->createForm('HVG\SystemBundle\Form\UnitGroupType', $unitGroup, array(
            'action' => $this->generateUrl('unitgroup_new'),
        ));
    }

    /**
     * Finds and displays a UnitGroup entity.
     *
     */
    public function showAction(UnitGroup $unitGroup)
    {
        $editForm = $this->createEditForm($unitGroup);
        $deleteForm = $this->createDeleteForm($unitGroup);

        return $this->render('unitgroup/show.html.twig', array(
            'unitGroup' => $unitGroup,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing UnitGroup entity.
     *
     */
    public function editAction(Request $request, UnitGroup $unitGroup)
    {
        $editForm = $this->createEditForm($unitGroup);
        $deleteForm = $this->createDeleteForm($unitGroup);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($unitGroup);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'unitGroup.flash.updated' );
            } else {
                return $this->render('unitgroup/edit.html.twig', array(
                    'unitGroup' => $unitGroup,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('unitgroup_index'));
    }

    /**
     * Creates a form to edit a UnitGroup entity.
     *
     * @param UnitGroup $unitGroup The UnitGroup entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(UnitGroup $unitGroup)
    {
        return $this->createForm('HVG\SystemBundle\Form\UnitGroupType', $unitGroup, array(
            'action' => $this->generateUrl('unitgroup_edit', array('id' => $unitGroup->getId())),
        ));
    }

    /**
     * Deletes a UnitGroup entity.
     *
     */
    public function deleteAction(Request $request, UnitGroup $unitGroup)
    {
        $deleteForm = $this->createDeleteForm($unitGroup);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($unitGroup);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'unitGroup.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('unitgroup_index'));
    }

    /**
     * Creates a form to delete a UnitGroup entity.
     *
     * @param UnitGroup $unitGroup The UnitGroup entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UnitGroup $unitGroup)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('unitgroup_delete', array('id' => $unitGroup->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
