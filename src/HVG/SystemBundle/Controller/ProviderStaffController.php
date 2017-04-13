<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\ProviderStaff;
use HVG\SystemBundle\Form\ProviderStaffType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Providerstaff controller.
 *
 */
class ProviderStaffController extends Controller
{

    /**
     * Lists all ProviderStaff entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $providerStaffs = $em->getRepository('HVGSystemBundle:ProviderStaff')->findBy(array(), array($sort => $direction));
        else $providerStaffs = $em->getRepository('HVGSystemBundle:ProviderStaff')->findAll();
        $paginator = $this->get('knp_paginator');
        $providerStaffs = $paginator->paginate($providerStaffs, $request->query->getInt('page', 1), 100);
        $providerStaff = new ProviderStaff();
        $newForm = $this->createNewForm($providerStaff)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($providerStaffs as $key => $providerStaff) {
            $editForms[] = $this->createEditForm($providerStaff)->createView();
            $deleteForms[] = $this->createDeleteForm($providerStaff)->createView();
        }

        return $this->render('providerstaff/index.html.twig', array(
            'providerStaffs' => $providerStaffs,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new ProviderStaff entity.
     *
     */
    public function newAction(Request $request)
    {
        $providerStaff = new ProviderStaff();
        $newForm = $this->createNewForm($providerStaff);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($providerStaff);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'providerStaff.flash.created' );
            } else {
                return $this->render('providerstaff/new.html.twig', array(
                    'providerStaff' => $providerStaff,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('providerstaff_index'));
    }

    /**
     * Creates a form to create a new ProviderStaff entity.
     *
     * @param ProviderStaff $providerStaff The ProviderStaff entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(ProviderStaff $providerStaff)
    {
        return $this->createForm('HVG\SystemBundle\Form\ProviderStaffType', $providerStaff, array(
            'action' => $this->generateUrl('providerstaff_new'),
        ));
    }

    /**
     * Finds and displays a ProviderStaff entity.
     *
     */
    public function showAction(ProviderStaff $providerStaff)
    {
        $editForm = $this->createEditForm($providerStaff);
        $deleteForm = $this->createDeleteForm($providerStaff);

        return $this->render('providerstaff/show.html.twig', array(
            'providerStaff' => $providerStaff,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProviderStaff entity.
     *
     */
    public function editAction(Request $request, ProviderStaff $providerStaff)
    {
        $editForm = $this->createEditForm($providerStaff);
        $deleteForm = $this->createDeleteForm($providerStaff);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($providerStaff);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'providerStaff.flash.updated' );
            } else {
                return $this->render('providerstaff/edit.html.twig', array(
                    'providerStaff' => $providerStaff,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('providerstaff_index'));
    }

    /**
     * Creates a form to edit a ProviderStaff entity.
     *
     * @param ProviderStaff $providerStaff The ProviderStaff entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(ProviderStaff $providerStaff)
    {
        return $this->createForm('HVG\SystemBundle\Form\ProviderStaffType', $providerStaff, array(
            'action' => $this->generateUrl('providerstaff_edit', array('id' => $providerStaff->getId())),
        ));
    }

    /**
     * Deletes a ProviderStaff entity.
     *
     */
    public function deleteAction(Request $request, ProviderStaff $providerStaff)
    {
        $deleteForm = $this->createDeleteForm($providerStaff);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($providerStaff);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'providerStaff.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('providerstaff_index'));
    }

    /**
     * Creates a form to delete a ProviderStaff entity.
     *
     * @param ProviderStaff $providerStaff The ProviderStaff entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProviderStaff $providerStaff)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('providerstaff_delete', array('id' => $providerStaff->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
