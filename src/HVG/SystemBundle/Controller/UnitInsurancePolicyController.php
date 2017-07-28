<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\UnitInsurancePolicy;
use HVG\SystemBundle\Form\UnitInsurancePolicyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Unitinsurancepolicy controller.
 *
 */
class UnitInsurancePolicyController extends Controller
{

    /**
     * Lists all UnitInsurancePolicy entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $unitInsurancePolicies = $em->getRepository('HVGSystemBundle:UnitInsurancePolicy')->findBy(array(), array($sort => $direction));
        else $unitInsurancePolicies = $em->getRepository('HVGSystemBundle:UnitInsurancePolicy')->findAll();
        $paginator = $this->get('knp_paginator');
        $unitInsurancePolicies = $paginator->paginate($unitInsurancePolicies, $request->query->getInt('page', 1), 100);
        $unitInsurancePolicy = new UnitInsurancePolicy();
        $newForm = $this->createNewForm($unitInsurancePolicy)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($unitInsurancePolicies as $key => $unitInsurancePolicy) {
            $editForms[] = $this->createEditForm($unitInsurancePolicy)->createView();
            $deleteForms[] = $this->createDeleteForm($unitInsurancePolicy)->createView();
        }

        return $this->render('unitinsurancepolicy/index.html.twig', array(
            'unitInsurancePolicies' => $unitInsurancePolicies,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new UnitInsurancePolicy entity.
     *
     */
    public function newAction(Request $request)
    {
        $unitInsurancePolicy = new UnitInsurancePolicy();
        $newForm = $this->createNewForm($unitInsurancePolicy);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($unitInsurancePolicy);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'unitInsurancePolicy.flash.created' );
            } else {
                return $this->render('unitinsurancepolicy/new.html.twig', array(
                    'unitInsurancePolicy' => $unitInsurancePolicy,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('unitinsurancepolicy_index'));
    }

    /**
     * Creates a form to create a new UnitInsurancePolicy entity.
     *
     * @param UnitInsurancePolicy $unitInsurancePolicy The UnitInsurancePolicy entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(UnitInsurancePolicy $unitInsurancePolicy)
    {
        return $this->createForm('HVG\SystemBundle\Form\UnitInsurancePolicyType', $unitInsurancePolicy, array(
            'action' => $this->generateUrl('unitinsurancepolicy_new'),
        ));
    }

    /**
     * Finds and displays a UnitInsurancePolicy entity.
     *
     */
    public function showAction(UnitInsurancePolicy $unitInsurancePolicy)
    {
        $editForm = $this->createEditForm($unitInsurancePolicy);
        $deleteForm = $this->createDeleteForm($unitInsurancePolicy);

        return $this->render('unitinsurancepolicy/show.html.twig', array(
            'unitInsurancePolicy' => $unitInsurancePolicy,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing UnitInsurancePolicy entity.
     *
     */
    public function editAction(Request $request, UnitInsurancePolicy $unitInsurancePolicy)
    {
        $editForm = $this->createEditForm($unitInsurancePolicy);
        $deleteForm = $this->createDeleteForm($unitInsurancePolicy);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($unitInsurancePolicy);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'unitInsurancePolicy.flash.updated' );
            } else {
                return $this->render('unitinsurancepolicy/edit.html.twig', array(
                    'unitInsurancePolicy' => $unitInsurancePolicy,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('unitinsurancepolicy_index'));
    }

    /**
     * Creates a form to edit a UnitInsurancePolicy entity.
     *
     * @param UnitInsurancePolicy $unitInsurancePolicy The UnitInsurancePolicy entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(UnitInsurancePolicy $unitInsurancePolicy)
    {
        return $this->createForm('HVG\SystemBundle\Form\UnitInsurancePolicyType', $unitInsurancePolicy, array(
            'action' => $this->generateUrl('unitinsurancepolicy_edit', array('id' => $unitInsurancePolicy->getId())),
        ));
    }

    /**
     * Deletes a UnitInsurancePolicy entity.
     *
     */
    public function deleteAction(Request $request, UnitInsurancePolicy $unitInsurancePolicy)
    {
        $deleteForm = $this->createDeleteForm($unitInsurancePolicy);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($unitInsurancePolicy);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'unitInsurancePolicy.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('unitinsurancepolicy_index'));
    }

    /**
     * Creates a form to delete a UnitInsurancePolicy entity.
     *
     * @param UnitInsurancePolicy $unitInsurancePolicy The UnitInsurancePolicy entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UnitInsurancePolicy $unitInsurancePolicy)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('unitinsurancepolicy_delete', array('id' => $unitInsurancePolicy->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
