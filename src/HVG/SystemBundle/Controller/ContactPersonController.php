<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\ContactPerson;
use HVG\SystemBundle\Form\ContactPersonType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Contactperson controller.
 *
 */
class ContactPersonController extends Controller
{

    /**
     * Lists all ContactPerson entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $contactPeople = $em->getRepository('HVGSystemBundle:ContactPerson')->findBy(array(), array($sort => $direction));
        else $contactPeople = $em->getRepository('HVGSystemBundle:ContactPerson')->findAll();
        $paginator = $this->get('knp_paginator');
        $contactPeople = $paginator->paginate($contactPeople, $request->query->getInt('page', 1), 100);
        $contactPerson = new ContactPerson();
        $newForm = $this->createNewForm($contactPerson)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($contactPeople as $key => $contactPerson) {
            $editForms[] = $this->createEditForm($contactPerson)->createView();
            $deleteForms[] = $this->createDeleteForm($contactPerson)->createView();
        }

        return $this->render('contactperson/index.html.twig', array(
            'contactPeople' => $contactPeople,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new ContactPerson entity.
     *
     */
    public function newAction(Request $request)
    {
        $contactPerson = new ContactPerson();
        $newForm = $this->createNewForm($contactPerson);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contactPerson);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'contactPerson.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new ContactPerson entity.
     *
     * @param ContactPerson $contactPerson The ContactPerson entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(ContactPerson $contactPerson)
    {
        return $this->createForm('HVG\SystemBundle\Form\ContactPersonType', $contactPerson, array(
            'action' => $this->generateUrl('contactperson_new'),
        ));
    }

    /**
     * Finds and displays a ContactPerson entity.
     *
     */
    public function showAction(ContactPerson $contactPerson)
    {
        $editForm = $this->createEditForm($contactPerson);
        $deleteForm = $this->createDeleteForm($contactPerson);

        return $this->render('contactperson/show.html.twig', array(
            'contactPerson' => $contactPerson,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ContactPerson entity.
     *
     */
    public function editAction(Request $request, ContactPerson $contactPerson)
    {
        $editForm = $this->createEditForm($contactPerson);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contactPerson);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'contactPerson.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a ContactPerson entity.
     *
     * @param ContactPerson $contactPerson The ContactPerson entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(ContactPerson $contactPerson)
    {
        return $this->createForm('HVG\SystemBundle\Form\ContactPersonType', $contactPerson, array(
            'action' => $this->generateUrl('contactperson_edit', array('id' => $contactPerson->getId())),
        ));
    }

    /**
     * Deletes a ContactPerson entity.
     *
     */
    public function deleteAction(Request $request, ContactPerson $contactPerson)
    {
        $deleteForm = $this->createDeleteForm($contactPerson);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contactPerson);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'contactPerson.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a ContactPerson entity.
     *
     * @param ContactPerson $contactPerson The ContactPerson entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ContactPerson $contactPerson)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contactperson_delete', array('id' => $contactPerson->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
