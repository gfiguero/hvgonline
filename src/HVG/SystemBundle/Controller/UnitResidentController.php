<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\UnitResident;
use HVG\SystemBundle\Form\UnitResidentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Unitresident controller.
 *
 */
class UnitResidentController extends Controller
{

    /**
     * Lists all UnitResident entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $unitResidents = $em->getRepository('HVGSystemBundle:UnitResident')->findBy(array(), array($sort => $direction));
        else $unitResidents = $em->getRepository('HVGSystemBundle:UnitResident')->findAll();
        $paginator = $this->get('knp_paginator');
        $unitResidents = $paginator->paginate($unitResidents, $request->query->getInt('page', 1), 100);
        $unitResident = new UnitResident();
        $newForm = $this->createNewForm($unitResident)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($unitResidents as $key => $unitResident) {
            $editForms[] = $this->createEditForm($unitResident)->createView();
            $deleteForms[] = $this->createDeleteForm($unitResident)->createView();
        }

        return $this->render('unitresident/index.html.twig', array(
            'unitResidents' => $unitResidents,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new UnitResident entity.
     *
     */
    public function newAction(Request $request)
    {
        $unitResident = new UnitResident();
        $newForm = $this->createNewForm($unitResident);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($unitResident);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'unitResident.flash.created' );
            } else {
                return $this->render('unitresident/new.html.twig', array(
                    'unitResident' => $unitResident,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('unitresident_index'));
    }

    /**
     * Creates a form to create a new UnitResident entity.
     *
     * @param UnitResident $unitResident The UnitResident entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(UnitResident $unitResident)
    {
        return $this->createForm('HVG\SystemBundle\Form\UnitResidentType', $unitResident, array(
            'action' => $this->generateUrl('unitresident_new'),
        ));
    }

    /**
     * Finds and displays a UnitResident entity.
     *
     */
    public function showAction(UnitResident $unitResident)
    {
        $editForm = $this->createEditForm($unitResident);
        $deleteForm = $this->createDeleteForm($unitResident);

        return $this->render('unitresident/show.html.twig', array(
            'unitResident' => $unitResident,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing UnitResident entity.
     *
     */
    public function editAction(Request $request, UnitResident $unitResident)
    {
        $editForm = $this->createEditForm($unitResident);
        $deleteForm = $this->createDeleteForm($unitResident);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($unitResident);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'unitResident.flash.updated' );
            } else {
                return $this->render('unitresident/edit.html.twig', array(
                    'unitResident' => $unitResident,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('unitresident_index'));
    }

    /**
     * Creates a form to edit a UnitResident entity.
     *
     * @param UnitResident $unitResident The UnitResident entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(UnitResident $unitResident)
    {
        return $this->createForm('HVG\SystemBundle\Form\UnitResidentType', $unitResident, array(
            'action' => $this->generateUrl('unitresident_edit', array('id' => $unitResident->getId())),
        ));
    }

    /**
     * Deletes a UnitResident entity.
     *
     */
    public function deleteAction(Request $request, UnitResident $unitResident)
    {
        $deleteForm = $this->createDeleteForm($unitResident);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($unitResident);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'unitResident.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('unitresident_index'));
    }

    /**
     * Creates a form to delete a UnitResident entity.
     *
     * @param UnitResident $unitResident The UnitResident entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UnitResident $unitResident)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('unitresident_delete', array('id' => $unitResident->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
