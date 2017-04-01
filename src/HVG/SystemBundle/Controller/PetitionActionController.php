<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\PetitionAction;
use HVG\SystemBundle\Form\PetitionActionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Petitionaction controller.
 *
 */
class PetitionActionController extends Controller
{

    /**
     * Lists all PetitionAction entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $petitionActions = $em->getRepository('HVGSystemBundle:PetitionAction')->findBy(array(), array($sort => $direction));
        else $petitionActions = $em->getRepository('HVGSystemBundle:PetitionAction')->findAll();
        $paginator = $this->get('knp_paginator');
        $petitionActions = $paginator->paginate($petitionActions, $request->query->getInt('page', 1), 100);
        $petitionAction = new PetitionAction();
        $newForm = $this->createNewForm($petitionAction)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($petitionActions as $key => $petitionAction) {
            $editForms[] = $this->createEditForm($petitionAction)->createView();
            $deleteForms[] = $this->createDeleteForm($petitionAction)->createView();
        }

        return $this->render('petitionaction/index.html.twig', array(
            'petitionActions' => $petitionActions,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new PetitionAction entity.
     *
     */
    public function newAction(Request $request)
    {
        $petitionAction = new PetitionAction();
        $newForm = $this->createNewForm($petitionAction);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($petitionAction);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'petitionAction.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new PetitionAction entity.
     *
     * @param PetitionAction $petitionAction The PetitionAction entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(PetitionAction $petitionAction)
    {
        return $this->createForm('HVG\SystemBundle\Form\PetitionActionType', $petitionAction, array(
            'action' => $this->generateUrl('petitionaction_new'),
        ));
    }

    /**
     * Finds and displays a PetitionAction entity.
     *
     */
    public function showAction(PetitionAction $petitionAction)
    {
        $editForm = $this->createEditForm($petitionAction);
        $deleteForm = $this->createDeleteForm($petitionAction);

        return $this->render('petitionaction/show.html.twig', array(
            'petitionAction' => $petitionAction,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PetitionAction entity.
     *
     */
    public function editAction(Request $request, PetitionAction $petitionAction)
    {
        $editForm = $this->createEditForm($petitionAction);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($petitionAction);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'petitionAction.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a PetitionAction entity.
     *
     * @param PetitionAction $petitionAction The PetitionAction entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(PetitionAction $petitionAction)
    {
        return $this->createForm('HVG\SystemBundle\Form\PetitionActionType', $petitionAction, array(
            'action' => $this->generateUrl('petitionaction_edit', array('id' => $petitionAction->getId())),
        ));
    }

    /**
     * Deletes a PetitionAction entity.
     *
     */
    public function deleteAction(Request $request, PetitionAction $petitionAction)
    {
        $deleteForm = $this->createDeleteForm($petitionAction);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($petitionAction);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'petitionAction.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a PetitionAction entity.
     *
     * @param PetitionAction $petitionAction The PetitionAction entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PetitionAction $petitionAction)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('petitionaction_delete', array('id' => $petitionAction->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
