<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\PetitionEvaluation;
use HVG\SystemBundle\Form\PetitionEvaluationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Petitionevaluation controller.
 *
 */
class PetitionEvaluationController extends Controller
{

    /**
     * Lists all PetitionEvaluation entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $petitionEvaluations = $em->getRepository('HVGSystemBundle:PetitionEvaluation')->findBy(array(), array($sort => $direction));
        else $petitionEvaluations = $em->getRepository('HVGSystemBundle:PetitionEvaluation')->findAll();
        $paginator = $this->get('knp_paginator');
        $petitionEvaluations = $paginator->paginate($petitionEvaluations, $request->query->getInt('page', 1), 100);
        $petitionEvaluation = new PetitionEvaluation();
        $newForm = $this->createNewForm($petitionEvaluation)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($petitionEvaluations as $key => $petitionEvaluation) {
            $editForms[] = $this->createEditForm($petitionEvaluation)->createView();
            $deleteForms[] = $this->createDeleteForm($petitionEvaluation)->createView();
        }

        return $this->render('petitionevaluation/index.html.twig', array(
            'petitionEvaluations' => $petitionEvaluations,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new PetitionEvaluation entity.
     *
     */
    public function newAction(Request $request)
    {
        $petitionEvaluation = new PetitionEvaluation();
        $newForm = $this->createNewForm($petitionEvaluation);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($petitionEvaluation);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'petitionEvaluation.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new PetitionEvaluation entity.
     *
     * @param PetitionEvaluation $petitionEvaluation The PetitionEvaluation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(PetitionEvaluation $petitionEvaluation)
    {
        return $this->createForm('HVG\SystemBundle\Form\PetitionEvaluationType', $petitionEvaluation, array(
            'action' => $this->generateUrl('petitionevaluation_new'),
        ));
    }

    /**
     * Finds and displays a PetitionEvaluation entity.
     *
     */
    public function showAction(PetitionEvaluation $petitionEvaluation)
    {
        $editForm = $this->createEditForm($petitionEvaluation);
        $deleteForm = $this->createDeleteForm($petitionEvaluation);

        return $this->render('petitionevaluation/show.html.twig', array(
            'petitionEvaluation' => $petitionEvaluation,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PetitionEvaluation entity.
     *
     */
    public function editAction(Request $request, PetitionEvaluation $petitionEvaluation)
    {
        $editForm = $this->createEditForm($petitionEvaluation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($petitionEvaluation);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'petitionEvaluation.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a PetitionEvaluation entity.
     *
     * @param PetitionEvaluation $petitionEvaluation The PetitionEvaluation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(PetitionEvaluation $petitionEvaluation)
    {
        return $this->createForm('HVG\SystemBundle\Form\PetitionEvaluationType', $petitionEvaluation, array(
            'action' => $this->generateUrl('petitionevaluation_edit', array('id' => $petitionEvaluation->getId())),
        ));
    }

    /**
     * Deletes a PetitionEvaluation entity.
     *
     */
    public function deleteAction(Request $request, PetitionEvaluation $petitionEvaluation)
    {
        $deleteForm = $this->createDeleteForm($petitionEvaluation);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($petitionEvaluation);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'petitionEvaluation.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a PetitionEvaluation entity.
     *
     * @param PetitionEvaluation $petitionEvaluation The PetitionEvaluation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PetitionEvaluation $petitionEvaluation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('petitionevaluation_delete', array('id' => $petitionEvaluation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
