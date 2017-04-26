<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\PetitionObjective;
use HVG\SystemBundle\Form\PetitionObjectiveType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Petitionobjective controller.
 *
 */
class PetitionObjectiveController extends Controller
{

    /**
     * Lists all PetitionObjective entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $petitionObjectives = $em->getRepository('HVGSystemBundle:PetitionObjective')->findBy(array(), array($sort => $direction));
        else $petitionObjectives = $em->getRepository('HVGSystemBundle:PetitionObjective')->findAll();
        $paginator = $this->get('knp_paginator');
        $petitionObjectives = $paginator->paginate($petitionObjectives, $request->query->getInt('page', 1), 100);
        $petitionObjective = new PetitionObjective();
        $newForm = $this->createNewForm($petitionObjective)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($petitionObjectives as $key => $petitionObjective) {
            $editForms[] = $this->createEditForm($petitionObjective)->createView();
            $deleteForms[] = $this->createDeleteForm($petitionObjective)->createView();
        }

        return $this->render('petitionobjective/index.html.twig', array(
            'petitionObjectives' => $petitionObjectives,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new PetitionObjective entity.
     *
     */
    public function newAction(Request $request)
    {
        $petitionObjective = new PetitionObjective();
        $newForm = $this->createNewForm($petitionObjective);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($petitionObjective);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'petitionObjective.flash.created' );
            } else {
                return $this->render('petitionobjective/new.html.twig', array(
                    'petitionObjective' => $petitionObjective,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('petitionobjective_index'));
    }

    /**
     * Creates a form to create a new PetitionObjective entity.
     *
     * @param PetitionObjective $petitionObjective The PetitionObjective entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(PetitionObjective $petitionObjective)
    {
        return $this->createForm('HVG\SystemBundle\Form\PetitionObjectiveType', $petitionObjective, array(
            'action' => $this->generateUrl('petitionobjective_new'),
        ));
    }

    /**
     * Finds and displays a PetitionObjective entity.
     *
     */
    public function showAction(PetitionObjective $petitionObjective)
    {
        $editForm = $this->createEditForm($petitionObjective);
        $deleteForm = $this->createDeleteForm($petitionObjective);

        return $this->render('petitionobjective/show.html.twig', array(
            'petitionObjective' => $petitionObjective,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PetitionObjective entity.
     *
     */
    public function editAction(Request $request, PetitionObjective $petitionObjective)
    {
        $editForm = $this->createEditForm($petitionObjective);
        $deleteForm = $this->createDeleteForm($petitionObjective);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($petitionObjective);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'petitionObjective.flash.updated' );
            } else {
                return $this->render('petitionobjective/edit.html.twig', array(
                    'petitionObjective' => $petitionObjective,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('petitionobjective_index'));
    }

    /**
     * Creates a form to edit a PetitionObjective entity.
     *
     * @param PetitionObjective $petitionObjective The PetitionObjective entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(PetitionObjective $petitionObjective)
    {
        return $this->createForm('HVG\SystemBundle\Form\PetitionObjectiveType', $petitionObjective, array(
            'action' => $this->generateUrl('petitionobjective_edit', array('id' => $petitionObjective->getId())),
        ));
    }

    /**
     * Deletes a PetitionObjective entity.
     *
     */
    public function deleteAction(Request $request, PetitionObjective $petitionObjective)
    {
        $deleteForm = $this->createDeleteForm($petitionObjective);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($petitionObjective);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'petitionObjective.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('petitionobjective_index'));
    }

    /**
     * Creates a form to delete a PetitionObjective entity.
     *
     * @param PetitionObjective $petitionObjective The PetitionObjective entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PetitionObjective $petitionObjective)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('petitionobjective_delete', array('id' => $petitionObjective->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
