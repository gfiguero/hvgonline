<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\ProjectStatus;
use HVG\SystemBundle\Form\ProjectStatusType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Projectstatus controller.
 *
 */
class ProjectStatusController extends Controller
{

    /**
     * Lists all ProjectStatus entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $projectStatuses = $em->getRepository('HVGSystemBundle:ProjectStatus')->findBy(array(), array($sort => $direction));
        else $projectStatuses = $em->getRepository('HVGSystemBundle:ProjectStatus')->findAll();
        $paginator = $this->get('knp_paginator');
        $projectStatuses = $paginator->paginate($projectStatuses, $request->query->getInt('page', 1), 100);
        $projectStatus = new ProjectStatus();
        $newForm = $this->createNewForm($projectStatus)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($projectStatuses as $key => $projectStatus) {
            $editForms[] = $this->createEditForm($projectStatus)->createView();
            $deleteForms[] = $this->createDeleteForm($projectStatus)->createView();
        }

        return $this->render('projectstatus/index.html.twig', array(
            'projectStatuses' => $projectStatuses,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new ProjectStatus entity.
     *
     */
    public function newAction(Request $request)
    {
        $projectStatus = new ProjectStatus();
        $newForm = $this->createNewForm($projectStatus);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($projectStatus);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'projectStatus.flash.created' );
            } else {
                return $this->render('projectstatus/new.html.twig', array(
                    'projectStatus' => $projectStatus,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('projectstatus_index'));
    }

    /**
     * Creates a form to create a new ProjectStatus entity.
     *
     * @param ProjectStatus $projectStatus The ProjectStatus entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(ProjectStatus $projectStatus)
    {
        return $this->createForm('HVG\SystemBundle\Form\ProjectStatusType', $projectStatus, array(
            'action' => $this->generateUrl('projectstatus_new'),
        ));
    }

    /**
     * Finds and displays a ProjectStatus entity.
     *
     */
    public function showAction(ProjectStatus $projectStatus)
    {
        $editForm = $this->createEditForm($projectStatus);
        $deleteForm = $this->createDeleteForm($projectStatus);

        return $this->render('projectstatus/show.html.twig', array(
            'projectStatus' => $projectStatus,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProjectStatus entity.
     *
     */
    public function editAction(Request $request, ProjectStatus $projectStatus)
    {
        $editForm = $this->createEditForm($projectStatus);
        $deleteForm = $this->createDeleteForm($projectStatus);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($projectStatus);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'projectStatus.flash.updated' );
            } else {
                return $this->render('projectstatus/edit.html.twig', array(
                    'projectStatus' => $projectStatus,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('projectstatus_index'));
    }

    /**
     * Creates a form to edit a ProjectStatus entity.
     *
     * @param ProjectStatus $projectStatus The ProjectStatus entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(ProjectStatus $projectStatus)
    {
        return $this->createForm('HVG\SystemBundle\Form\ProjectStatusType', $projectStatus, array(
            'action' => $this->generateUrl('projectstatus_edit', array('id' => $projectStatus->getId())),
        ));
    }

    /**
     * Deletes a ProjectStatus entity.
     *
     */
    public function deleteAction(Request $request, ProjectStatus $projectStatus)
    {
        $deleteForm = $this->createDeleteForm($projectStatus);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projectStatus);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'projectStatus.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('projectstatus_index'));
    }

    /**
     * Creates a form to delete a ProjectStatus entity.
     *
     * @param ProjectStatus $projectStatus The ProjectStatus entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProjectStatus $projectStatus)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('projectstatus_delete', array('id' => $projectStatus->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
