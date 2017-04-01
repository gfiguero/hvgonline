<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Petition;
use HVG\SystemBundle\Form\PetitionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Petition controller.
 *
 */
class PetitionController extends Controller
{

    /**
     * Lists all Petition entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $petitions = $em->getRepository('HVGSystemBundle:Petition')->findBy(array(), array($sort => $direction));
        else $petitions = $em->getRepository('HVGSystemBundle:Petition')->findAll();
        $paginator = $this->get('knp_paginator');
        $petitions = $paginator->paginate($petitions, $request->query->getInt('page', 1), 100);
        $petition = new Petition();
        $newForm = $this->createNewForm($petition)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($petitions as $key => $petition) {
            $editForms[] = $this->createEditForm($petition)->createView();
            $deleteForms[] = $this->createDeleteForm($petition)->createView();
        }

        return $this->render('petition/index.html.twig', array(
            'petitions' => $petitions,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Petition entity.
     *
     */
    public function newAction(Request $request)
    {
        $petition = new Petition();
        $newForm = $this->createNewForm($petition);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($petition);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'petition.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new Petition entity.
     *
     * @param Petition $petition The Petition entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Petition $petition)
    {
        return $this->createForm('HVG\SystemBundle\Form\PetitionType', $petition, array(
            'action' => $this->generateUrl('petition_new'),
        ));
    }

    /**
     * Finds and displays a Petition entity.
     *
     */
    public function showAction(Petition $petition)
    {
        $editForm = $this->createEditForm($petition);
        $deleteForm = $this->createDeleteForm($petition);

        return $this->render('petition/show.html.twig', array(
            'petition' => $petition,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Petition entity.
     *
     */
    public function editAction(Request $request, Petition $petition)
    {
        $editForm = $this->createEditForm($petition);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($petition);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'petition.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a Petition entity.
     *
     * @param Petition $petition The Petition entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Petition $petition)
    {
        return $this->createForm('HVG\SystemBundle\Form\PetitionType', $petition, array(
            'action' => $this->generateUrl('petition_edit', array('id' => $petition->getId())),
        ));
    }

    /**
     * Deletes a Petition entity.
     *
     */
    public function deleteAction(Request $request, Petition $petition)
    {
        $deleteForm = $this->createDeleteForm($petition);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($petition);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'petition.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a Petition entity.
     *
     * @param Petition $petition The Petition entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Petition $petition)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('petition_delete', array('id' => $petition->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
