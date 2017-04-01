<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\ProjectObservation;
use HVG\SystemBundle\Form\ProjectObservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Projectobservation controller.
 *
 */
class ProjectObservationController extends Controller
{

    /**
     * Lists all ProjectObservation entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $projectObservations = $em->getRepository('HVGSystemBundle:ProjectObservation')->findBy(array(), array($sort => $direction));
        else $projectObservations = $em->getRepository('HVGSystemBundle:ProjectObservation')->findAll();
        $paginator = $this->get('knp_paginator');
        $projectObservations = $paginator->paginate($projectObservations, $request->query->getInt('page', 1), 100);
        $projectObservation = new ProjectObservation();
        $newForm = $this->createNewForm($projectObservation)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($projectObservations as $key => $projectObservation) {
            $editForms[] = $this->createEditForm($projectObservation)->createView();
            $deleteForms[] = $this->createDeleteForm($projectObservation)->createView();
        }

        return $this->render('projectobservation/index.html.twig', array(
            'projectObservations' => $projectObservations,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new ProjectObservation entity.
     *
     */
    public function newAction(Request $request)
    {
        $projectObservation = new ProjectObservation();
        $newForm = $this->createNewForm($projectObservation);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($projectObservation);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'projectObservation.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new ProjectObservation entity.
     *
     * @param ProjectObservation $projectObservation The ProjectObservation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(ProjectObservation $projectObservation)
    {
        return $this->createForm('HVG\SystemBundle\Form\ProjectObservationType', $projectObservation, array(
            'action' => $this->generateUrl('projectobservation_new'),
        ));
    }

    /**
     * Finds and displays a ProjectObservation entity.
     *
     */
    public function showAction(ProjectObservation $projectObservation)
    {
        $editForm = $this->createEditForm($projectObservation);
        $deleteForm = $this->createDeleteForm($projectObservation);

        return $this->render('projectobservation/show.html.twig', array(
            'projectObservation' => $projectObservation,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProjectObservation entity.
     *
     */
    public function editAction(Request $request, ProjectObservation $projectObservation)
    {
        $editForm = $this->createEditForm($projectObservation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($projectObservation);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'projectObservation.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a ProjectObservation entity.
     *
     * @param ProjectObservation $projectObservation The ProjectObservation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(ProjectObservation $projectObservation)
    {
        return $this->createForm('HVG\SystemBundle\Form\ProjectObservationType', $projectObservation, array(
            'action' => $this->generateUrl('projectobservation_edit', array('id' => $projectObservation->getId())),
        ));
    }

    /**
     * Deletes a ProjectObservation entity.
     *
     */
    public function deleteAction(Request $request, ProjectObservation $projectObservation)
    {
        $deleteForm = $this->createDeleteForm($projectObservation);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projectObservation);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'projectObservation.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a ProjectObservation entity.
     *
     * @param ProjectObservation $projectObservation The ProjectObservation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProjectObservation $projectObservation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('projectobservation_delete', array('id' => $projectObservation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
