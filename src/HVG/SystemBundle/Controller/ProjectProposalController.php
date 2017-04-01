<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\ProjectProposal;
use HVG\SystemBundle\Form\ProjectProposalType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Projectproposal controller.
 *
 */
class ProjectProposalController extends Controller
{

    /**
     * Lists all ProjectProposal entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $projectProposals = $em->getRepository('HVGSystemBundle:ProjectProposal')->findBy(array(), array($sort => $direction));
        else $projectProposals = $em->getRepository('HVGSystemBundle:ProjectProposal')->findAll();
        $paginator = $this->get('knp_paginator');
        $projectProposals = $paginator->paginate($projectProposals, $request->query->getInt('page', 1), 100);
        $projectProposal = new ProjectProposal();
        $newForm = $this->createNewForm($projectProposal)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($projectProposals as $key => $projectProposal) {
            $editForms[] = $this->createEditForm($projectProposal)->createView();
            $deleteForms[] = $this->createDeleteForm($projectProposal)->createView();
        }

        return $this->render('projectproposal/index.html.twig', array(
            'projectProposals' => $projectProposals,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new ProjectProposal entity.
     *
     */
    public function newAction(Request $request)
    {
        $projectProposal = new ProjectProposal();
        $newForm = $this->createNewForm($projectProposal);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($projectProposal);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'projectProposal.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new ProjectProposal entity.
     *
     * @param ProjectProposal $projectProposal The ProjectProposal entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(ProjectProposal $projectProposal)
    {
        return $this->createForm('HVG\SystemBundle\Form\ProjectProposalType', $projectProposal, array(
            'action' => $this->generateUrl('projectproposal_new'),
        ));
    }

    /**
     * Finds and displays a ProjectProposal entity.
     *
     */
    public function showAction(ProjectProposal $projectProposal)
    {
        $editForm = $this->createEditForm($projectProposal);
        $deleteForm = $this->createDeleteForm($projectProposal);

        return $this->render('projectproposal/show.html.twig', array(
            'projectProposal' => $projectProposal,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProjectProposal entity.
     *
     */
    public function editAction(Request $request, ProjectProposal $projectProposal)
    {
        $editForm = $this->createEditForm($projectProposal);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($projectProposal);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'projectProposal.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a ProjectProposal entity.
     *
     * @param ProjectProposal $projectProposal The ProjectProposal entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(ProjectProposal $projectProposal)
    {
        return $this->createForm('HVG\SystemBundle\Form\ProjectProposalType', $projectProposal, array(
            'action' => $this->generateUrl('projectproposal_edit', array('id' => $projectProposal->getId())),
        ));
    }

    /**
     * Deletes a ProjectProposal entity.
     *
     */
    public function deleteAction(Request $request, ProjectProposal $projectProposal)
    {
        $deleteForm = $this->createDeleteForm($projectProposal);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projectProposal);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'projectProposal.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a ProjectProposal entity.
     *
     * @param ProjectProposal $projectProposal The ProjectProposal entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProjectProposal $projectProposal)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('projectproposal_delete', array('id' => $projectProposal->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
