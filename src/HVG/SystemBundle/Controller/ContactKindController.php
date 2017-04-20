<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\ContactKind;
use HVG\SystemBundle\Form\ContactKindType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Contactkind controller.
 *
 */
class ContactKindController extends Controller
{

    /**
     * Lists all ContactKind entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $contactKinds = $em->getRepository('HVGSystemBundle:ContactKind')->findBy(array(), array($sort => $direction));
        else $contactKinds = $em->getRepository('HVGSystemBundle:ContactKind')->findAll();
        $paginator = $this->get('knp_paginator');
        $contactKinds = $paginator->paginate($contactKinds, $request->query->getInt('page', 1), 100);
        $contactKind = new ContactKind();
        $newForm = $this->createNewForm($contactKind)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($contactKinds as $key => $contactKind) {
            $editForms[] = $this->createEditForm($contactKind)->createView();
            $deleteForms[] = $this->createDeleteForm($contactKind)->createView();
        }

        return $this->render('contactkind/index.html.twig', array(
            'contactKinds' => $contactKinds,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new ContactKind entity.
     *
     */
    public function newAction(Request $request)
    {
        $contactKind = new ContactKind();
        $newForm = $this->createNewForm($contactKind);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($contactKind);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'contactKind.flash.created' );
            } else {
                return $this->render('contactkind/new.html.twig', array(
                    'contactKind' => $contactKind,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('contactkind_index'));
    }

    /**
     * Creates a form to create a new ContactKind entity.
     *
     * @param ContactKind $contactKind The ContactKind entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(ContactKind $contactKind)
    {
        return $this->createForm('HVG\SystemBundle\Form\ContactKindType', $contactKind, array(
            'action' => $this->generateUrl('contactkind_new'),
        ));
    }

    /**
     * Finds and displays a ContactKind entity.
     *
     */
    public function showAction(ContactKind $contactKind)
    {
        $editForm = $this->createEditForm($contactKind);
        $deleteForm = $this->createDeleteForm($contactKind);

        return $this->render('contactkind/show.html.twig', array(
            'contactKind' => $contactKind,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ContactKind entity.
     *
     */
    public function editAction(Request $request, ContactKind $contactKind)
    {
        $editForm = $this->createEditForm($contactKind);
        $deleteForm = $this->createDeleteForm($contactKind);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($contactKind);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'contactKind.flash.updated' );
            } else {
                return $this->render('contactkind/edit.html.twig', array(
                    'contactKind' => $contactKind,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('contactkind_index'));
    }

    /**
     * Creates a form to edit a ContactKind entity.
     *
     * @param ContactKind $contactKind The ContactKind entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(ContactKind $contactKind)
    {
        return $this->createForm('HVG\SystemBundle\Form\ContactKindType', $contactKind, array(
            'action' => $this->generateUrl('contactkind_edit', array('id' => $contactKind->getId())),
        ));
    }

    /**
     * Deletes a ContactKind entity.
     *
     */
    public function deleteAction(Request $request, ContactKind $contactKind)
    {
        $deleteForm = $this->createDeleteForm($contactKind);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contactKind);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'contactKind.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('contactkind_index'));
    }

    /**
     * Creates a form to delete a ContactKind entity.
     *
     * @param ContactKind $contactKind The ContactKind entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ContactKind $contactKind)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contactkind_delete', array('id' => $contactKind->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
