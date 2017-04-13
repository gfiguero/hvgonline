<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\PetitionStatus;
use HVG\SystemBundle\Form\PetitionStatusType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Petitionstatus controller.
 *
 */
class PetitionStatusController extends Controller
{

    /**
     * Lists all PetitionStatus entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $petitionStatuses = $em->getRepository('HVGSystemBundle:PetitionStatus')->findBy(array(), array($sort => $direction));
        else $petitionStatuses = $em->getRepository('HVGSystemBundle:PetitionStatus')->findAll();
        $paginator = $this->get('knp_paginator');
        $petitionStatuses = $paginator->paginate($petitionStatuses, $request->query->getInt('page', 1), 100);
        $petitionStatus = new PetitionStatus();
        $newForm = $this->createNewForm($petitionStatus)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($petitionStatuses as $key => $petitionStatus) {
            $editForms[] = $this->createEditForm($petitionStatus)->createView();
            $deleteForms[] = $this->createDeleteForm($petitionStatus)->createView();
        }

        return $this->render('petitionstatus/index.html.twig', array(
            'petitionStatuses' => $petitionStatuses,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new PetitionStatus entity.
     *
     */
    public function newAction(Request $request)
    {
        $petitionStatus = new PetitionStatus();
        $newForm = $this->createNewForm($petitionStatus);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($petitionStatus);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'petitionStatus.flash.created' );
            } else {
                return $this->render('petitionstatus/new.html.twig', array(
                    'petitionStatus' => $petitionStatus,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('petitionstatus_index'));
    }

    /**
     * Creates a form to create a new PetitionStatus entity.
     *
     * @param PetitionStatus $petitionStatus The PetitionStatus entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(PetitionStatus $petitionStatus)
    {
        return $this->createForm('HVG\SystemBundle\Form\PetitionStatusType', $petitionStatus, array(
            'action' => $this->generateUrl('petitionstatus_new'),
        ));
    }

    /**
     * Finds and displays a PetitionStatus entity.
     *
     */
    public function showAction(PetitionStatus $petitionStatus)
    {
        $editForm = $this->createEditForm($petitionStatus);
        $deleteForm = $this->createDeleteForm($petitionStatus);

        return $this->render('petitionstatus/show.html.twig', array(
            'petitionStatus' => $petitionStatus,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PetitionStatus entity.
     *
     */
    public function editAction(Request $request, PetitionStatus $petitionStatus)
    {
        $editForm = $this->createEditForm($petitionStatus);
        $deleteForm = $this->createDeleteForm($petitionStatus);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($petitionStatus);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'petitionStatus.flash.updated' );
            } else {
                return $this->render('petitionstatus/edit.html.twig', array(
                    'petitionStatus' => $petitionStatus,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('petitionstatus_index'));
    }

    /**
     * Creates a form to edit a PetitionStatus entity.
     *
     * @param PetitionStatus $petitionStatus The PetitionStatus entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(PetitionStatus $petitionStatus)
    {
        return $this->createForm('HVG\SystemBundle\Form\PetitionStatusType', $petitionStatus, array(
            'action' => $this->generateUrl('petitionstatus_edit', array('id' => $petitionStatus->getId())),
        ));
    }

    /**
     * Deletes a PetitionStatus entity.
     *
     */
    public function deleteAction(Request $request, PetitionStatus $petitionStatus)
    {
        $deleteForm = $this->createDeleteForm($petitionStatus);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($petitionStatus);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'petitionStatus.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('petitionstatus_index'));
    }

    /**
     * Creates a form to delete a PetitionStatus entity.
     *
     * @param PetitionStatus $petitionStatus The PetitionStatus entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PetitionStatus $petitionStatus)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('petitionstatus_delete', array('id' => $petitionStatus->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
