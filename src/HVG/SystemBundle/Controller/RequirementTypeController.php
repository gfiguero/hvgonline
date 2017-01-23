<?php

namespace HVG\SystemBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HVG\SystemBundle\Entity\RequirementType;
use HVG\SystemBundle\Form\RequirementTypeType;

class RequirementTypeController extends Controller
{
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $requirementTypes = $em->getRepository('HVGSystemBundle:RequirementType')->findBy(array(), array($sort => $direction));
        else $requirementTypes = $em->getRepository('HVGSystemBundle:RequirementType')->findAll();
        $paginator = $this->get('knp_paginator');
        $requirementTypes = $paginator->paginate($requirementTypes, $request->query->getInt('page', 1), 24);

        $deleteForms = array();
        $editForms = array();
        $requirementType = new RequirementType();
        $newForm = $this->createForm('HVG\SystemBundle\Form\RequirementTypeType', $requirementType, array(
            'action' => $this->generateUrl('requirement_type_new'),
        ))->createView();

        foreach ($requirementTypes as $key => $requirementType) {
            $editForms[] = $this->createForm('HVG\SystemBundle\Form\RequirementTypeType', $requirementType, array(
                'action' => $this->generateUrl('requirement_type_edit', array('id' => $requirementType->getId())),
            ))->createView();
            $deleteForms[] = $this->createDeleteForm($requirementType, array(
                'action' => $this->generateUrl('requirement_type_delete', array('id' => $requirementType->getId())),
            ))->createView();
        }

        return $this->render('HVGSystemBundle:Requirement:type.html.twig', array(
            'requirementTypes' => $requirementTypes,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new RequirementType entity.
     *
     */
    public function newAction(Request $request)
    {
        $requirementType = new RequirementType();
        $form = $this->createForm('HVG\SystemBundle\Form\RequirementTypeType', $requirementType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($requirementType);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'requirement.type.new.flash' );

        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Displays a form to edit an existing RequirementType entity.
     *
     */
    public function editAction(Request $request, RequirementType $requirementType)
    {
        $deleteForm = $this->createDeleteForm($requirementType);
        $editForm = $this->createForm('HVG\SystemBundle\Form\RequirementTypeType', $requirementType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($requirementType);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'requirement.type.edit.flash' );

            return $this->redirect($request->headers->get('referer'));
        }

        return $this->render('requirementType/edit.html.twig', array(
            'requirementType' => $requirementType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a RequirementType entity.
     *
     */
    public function deleteAction(Request $request, RequirementType $requirementType)
    {
        $form = $this->createDeleteForm($requirementType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($requirementType);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'requirement.type.delete.flash' );
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a RequirementType entity.
     *
     * @param RequirementType $requirementType The RequirementType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RequirementType $requirementType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('requirement_type_delete', array('id' => $requirementType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
