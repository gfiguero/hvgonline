<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Project;
use HVG\SystemBundle\Form\ProjectType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Project controller.
 *
 */
class ProjectController extends Controller
{

    /**
     * Lists all Project entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $projects = $em->getRepository('HVGSystemBundle:Project')->findBy(array(), array($sort => $direction));
        else $projects = $em->getRepository('HVGSystemBundle:Project')->findAll();
        $paginator = $this->get('knp_paginator');
        $projects = $paginator->paginate($projects, $request->query->getInt('page', 1), 100);
        $project = new Project();
        $newForm = $this->createNewForm($project)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($projects as $key => $project) {
            $editForms[] = $this->createEditForm($project)->createView();
            $deleteForms[] = $this->createDeleteForm($project)->createView();
        }

        return $this->render('project/index.html.twig', array(
            'projects' => $projects,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Project entity.
     *
     */
    public function newAction(Request $request)
    {
        $project = new Project();
        $newForm = $this->createNewForm($project);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'project.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new Project entity.
     *
     * @param Project $project The Project entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Project $project)
    {
        return $this->createForm('HVG\SystemBundle\Form\ProjectType', $project, array(
            'action' => $this->generateUrl('project_new'),
        ));
    }

    /**
     * Finds and displays a Project entity.
     *
     */
    public function showAction(Project $project)
    {
        $editForm = $this->createEditForm($project);
        $deleteForm = $this->createDeleteForm($project);

        return $this->render('project/show.html.twig', array(
            'project' => $project,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Project entity.
     *
     */
    public function editAction(Request $request, Project $project)
    {
        $editForm = $this->createEditForm($project);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'project.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a Project entity.
     *
     * @param Project $project The Project entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Project $project)
    {
        return $this->createForm('HVG\SystemBundle\Form\ProjectType', $project, array(
            'action' => $this->generateUrl('project_edit', array('id' => $project->getId())),
        ));
    }

    /**
     * Deletes a Project entity.
     *
     */
    public function deleteAction(Request $request, Project $project)
    {
        $deleteForm = $this->createDeleteForm($project);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($project);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'project.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a Project entity.
     *
     * @param Project $project The Project entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Project $project)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('project_delete', array('id' => $project->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
