<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\ProjectCommand;
use HVG\SystemBundle\Form\ProjectCommandType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Projectcommand controller.
 *
 */
class ProjectCommandController extends Controller
{

    /**
     * Lists all ProjectCommand entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $projectCommands = $em->getRepository('HVGSystemBundle:ProjectCommand')->findBy(array(), array($sort => $direction));
        else $projectCommands = $em->getRepository('HVGSystemBundle:ProjectCommand')->findAll();
        $paginator = $this->get('knp_paginator');
        $projectCommands = $paginator->paginate($projectCommands, $request->query->getInt('page', 1), 100);
        $projectCommand = new ProjectCommand();
        $newForm = $this->createNewForm($projectCommand)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($projectCommands as $key => $projectCommand) {
            $editForms[] = $this->createEditForm($projectCommand)->createView();
            $deleteForms[] = $this->createDeleteForm($projectCommand)->createView();
        }

        return $this->render('projectcommand/index.html.twig', array(
            'projectCommands' => $projectCommands,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new ProjectCommand entity.
     *
     */
    public function newAction(Request $request)
    {
        $projectCommand = new ProjectCommand();
        $newForm = $this->createNewForm($projectCommand);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($projectCommand);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'projectCommand.flash.created' );
            } else {
                return $this->render('projectcommand/new.html.twig', array(
                    'projectCommand' => $projectCommand,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('projectcommand_index'));
    }

    /**
     * Creates a form to create a new ProjectCommand entity.
     *
     * @param ProjectCommand $projectCommand The ProjectCommand entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(ProjectCommand $projectCommand)
    {
        return $this->createForm('HVG\SystemBundle\Form\ProjectCommandType', $projectCommand, array(
            'action' => $this->generateUrl('projectcommand_new'),
        ));
    }

    /**
     * Finds and displays a ProjectCommand entity.
     *
     */
    public function showAction(ProjectCommand $projectCommand)
    {
        $editForm = $this->createEditForm($projectCommand);
        $deleteForm = $this->createDeleteForm($projectCommand);

        return $this->render('projectcommand/show.html.twig', array(
            'projectCommand' => $projectCommand,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProjectCommand entity.
     *
     */
    public function editAction(Request $request, ProjectCommand $projectCommand)
    {
        $editForm = $this->createEditForm($projectCommand);
        $deleteForm = $this->createDeleteForm($projectCommand);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($projectCommand);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'projectCommand.flash.updated' );
            } else {
                return $this->render('projectcommand/edit.html.twig', array(
                    'projectCommand' => $projectCommand,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('projectcommand_index'));
    }

    /**
     * Creates a form to edit a ProjectCommand entity.
     *
     * @param ProjectCommand $projectCommand The ProjectCommand entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(ProjectCommand $projectCommand)
    {
        return $this->createForm('HVG\SystemBundle\Form\ProjectCommandType', $projectCommand, array(
            'action' => $this->generateUrl('projectcommand_edit', array('id' => $projectCommand->getId())),
        ));
    }

    /**
     * Deletes a ProjectCommand entity.
     *
     */
    public function deleteAction(Request $request, ProjectCommand $projectCommand)
    {
        $deleteForm = $this->createDeleteForm($projectCommand);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projectCommand);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'projectCommand.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('projectcommand_index'));
    }

    /**
     * Creates a form to delete a ProjectCommand entity.
     *
     * @param ProjectCommand $projectCommand The ProjectCommand entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProjectCommand $projectCommand)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('projectcommand_delete', array('id' => $projectCommand->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
