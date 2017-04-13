<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Contact;
use HVG\SystemBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Contact controller.
 *
 */
class ContactController extends Controller
{

    /**
     * Lists all Contact entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $contacts = $em->getRepository('HVGSystemBundle:Contact')->findBy(array(), array($sort => $direction));
        else $contacts = $em->getRepository('HVGSystemBundle:Contact')->findAll();
        $paginator = $this->get('knp_paginator');
        $contacts = $paginator->paginate($contacts, $request->query->getInt('page', 1), 100);
        $contact = new Contact();
        $newForm = $this->createNewForm($contact)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($contacts as $key => $contact) {
            $editForms[] = $this->createEditForm($contact)->createView();
            $deleteForms[] = $this->createDeleteForm($contact)->createView();
        }

        return $this->render('contact/index.html.twig', array(
            'contacts' => $contacts,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Contact entity.
     *
     */
    public function newAction(Request $request)
    {
        $contact = new Contact();
        $newForm = $this->createNewForm($contact);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($contact);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'contact.flash.created' );
            } else {
                return $this->render('contact/new.html.twig', array(
                    'contact' => $contact,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('contact_index'));
    }

    /**
     * Creates a form to create a new Contact entity.
     *
     * @param Contact $contact The Contact entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Contact $contact)
    {
        return $this->createForm('HVG\SystemBundle\Form\ContactType', $contact, array(
            'action' => $this->generateUrl('contact_new'),
        ));
    }

    /**
     * Finds and displays a Contact entity.
     *
     */
    public function showAction(Contact $contact)
    {
        $editForm = $this->createEditForm($contact);
        $deleteForm = $this->createDeleteForm($contact);

        return $this->render('contact/show.html.twig', array(
            'contact' => $contact,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Contact entity.
     *
     */
    public function editAction(Request $request, Contact $contact)
    {
        $editForm = $this->createEditForm($contact);
        $deleteForm = $this->createDeleteForm($contact);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($contact);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'contact.flash.updated' );
            } else {
                return $this->render('contact/edit.html.twig', array(
                    'contact' => $contact,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('contact_index'));
    }

    /**
     * Creates a form to edit a Contact entity.
     *
     * @param Contact $contact The Contact entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Contact $contact)
    {
        return $this->createForm('HVG\SystemBundle\Form\ContactType', $contact, array(
            'action' => $this->generateUrl('contact_edit', array('id' => $contact->getId())),
        ));
    }

    /**
     * Deletes a Contact entity.
     *
     */
    public function deleteAction(Request $request, Contact $contact)
    {
        $deleteForm = $this->createDeleteForm($contact);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contact);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'contact.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('contact_index'));
    }

    /**
     * Creates a form to delete a Contact entity.
     *
     * @param Contact $contact The Contact entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Contact $contact)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contact_delete', array('id' => $contact->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
