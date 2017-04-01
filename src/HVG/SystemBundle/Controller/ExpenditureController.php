<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Expenditure;
use HVG\SystemBundle\Form\ExpenditureType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Expenditure controller.
 *
 */
class ExpenditureController extends Controller
{

    /**
     * Lists all Expenditure entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $expenditures = $em->getRepository('HVGSystemBundle:Expenditure')->findBy(array(), array($sort => $direction));
        else $expenditures = $em->getRepository('HVGSystemBundle:Expenditure')->findAll();
        $paginator = $this->get('knp_paginator');
        $expenditures = $paginator->paginate($expenditures, $request->query->getInt('page', 1), 30);
        $expenditure = new Expenditure();
        $newForm = $this->createNewForm($expenditure)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($expenditures as $key => $expenditure) {
            $editForms[] = $this->createEditForm($expenditure)->createView();
            $deleteForms[] = $this->createDeleteForm($expenditure)->createView();
        }

        return $this->render('expenditure/index.html.twig', array(
            'expenditures' => $expenditures,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Expenditure entity.
     *
     */
    public function newAction(Request $request)
    {
        $expenditure = new Expenditure();
        $newForm = $this->createNewForm($expenditure);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($expenditure);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'expenditure.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new Expenditure entity.
     *
     * @param Expenditure $expenditure The Expenditure entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Expenditure $expenditure)
    {
        return $this->createForm('HVG\SystemBundle\Form\ExpenditureType', $expenditure, array(
            'action' => $this->generateUrl('expenditure_new'),
        ));
    }

    /**
     * Finds and displays a Expenditure entity.
     *
     */
    public function showAction(Expenditure $expenditure)
    {
        $editForm = $this->createEditForm($expenditure);
        $deleteForm = $this->createDeleteForm($expenditure);

        return $this->render('expenditure/show.html.twig', array(
            'expenditure' => $expenditure,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Expenditure entity.
     *
     */
    public function editAction(Request $request, Expenditure $expenditure)
    {
        $editForm = $this->createEditForm($expenditure);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($expenditure);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'expenditure.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a Expenditure entity.
     *
     * @param Expenditure $expenditure The Expenditure entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Expenditure $expenditure)
    {
        return $this->createForm('HVG\SystemBundle\Form\ExpenditureType', $expenditure, array(
            'action' => $this->generateUrl('expenditure_edit', array('id' => $expenditure->getId())),
        ));
    }

    /**
     * Deletes a Expenditure entity.
     *
     */
    public function deleteAction(Request $request, Expenditure $expenditure)
    {
        $deleteForm = $this->createDeleteForm($expenditure);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($expenditure);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'expenditure.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a Expenditure entity.
     *
     * @param Expenditure $expenditure The Expenditure entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Expenditure $expenditure)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('expenditure_delete', array('id' => $expenditure->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
