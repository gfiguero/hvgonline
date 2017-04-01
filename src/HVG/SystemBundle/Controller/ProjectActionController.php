<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\ProjectAction;
use HVG\SystemBundle\Form\ProjectActionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Projectaction controller.
 *
 */
class ProjectActionController extends Controller
{

    /**
     * Lists all ProjectAction entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $projectActions = $em->getRepository('HVGSystemBundle:ProjectAction')->findBy(array(), array($sort => $direction));
        else $projectActions = $em->getRepository('HVGSystemBundle:ProjectAction')->findAll();
        $paginator = $this->get('knp_paginator');
        $projectActions = $paginator->paginate($projectActions, $request->query->getInt('page', 1), 100);
        $projectAction = new ProjectAction();
        $newForm = $this->createNewForm($projectAction)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($projectActions as $key => $projectAction) {
            $editForms[] = $this->createEditForm($projectAction)->createView();
            $deleteForms[] = $this->createDeleteForm($projectAction)->createView();
        }

        return $this->render('projectaction/index.html.twig', array(
            'projectActions' => $projectActions,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new ProjectAction entity.
     *
     */
    public function newAction(Request $request)
    {
        $projectAction = new ProjectAction();
        $newForm = $this->createNewForm($projectAction);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($projectAction);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'projectAction.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new ProjectAction entity.
     *
     * @param ProjectAction $projectAction The ProjectAction entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(ProjectAction $projectAction)
    {
        return $this->createForm('HVG\SystemBundle\Form\ProjectActionType', $projectAction, array(
            'action' => $this->generateUrl('projectaction_new'),
        ));
    }

    /**
     * Finds and displays a ProjectAction entity.
     *
     */
    public function showAction(ProjectAction $projectAction)
    {
        $editForm = $this->createEditForm($projectAction);
        $deleteForm = $this->createDeleteForm($projectAction);

        return $this->render('projectaction/show.html.twig', array(
            'projectAction' => $projectAction,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProjectAction entity.
     *
     */
    public function editAction(Request $request, ProjectAction $projectAction)
    {
        $editForm = $this->createEditForm($projectAction);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($projectAction);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'projectAction.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a ProjectAction entity.
     *
     * @param ProjectAction $projectAction The ProjectAction entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(ProjectAction $projectAction)
    {
        return $this->createForm('HVG\SystemBundle\Form\ProjectActionType', $projectAction, array(
            'action' => $this->generateUrl('projectaction_edit', array('id' => $projectAction->getId())),
        ));
    }

    /**
     * Deletes a ProjectAction entity.
     *
     */
    public function deleteAction(Request $request, ProjectAction $projectAction)
    {
        $deleteForm = $this->createDeleteForm($projectAction);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projectAction);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'projectAction.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a ProjectAction entity.
     *
     * @param ProjectAction $projectAction The ProjectAction entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProjectAction $projectAction)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('projectaction_delete', array('id' => $projectAction->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
