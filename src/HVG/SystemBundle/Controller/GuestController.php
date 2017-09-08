<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Guest;
use HVG\SystemBundle\Form\GuestType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Guest controller.
 *
 */
class GuestController extends Controller
{

    /**
     * Lists all Guest entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $guests = $em->getRepository('HVGSystemBundle:Guest')->findBy(array(), array($sort => $direction));
        else $guests = $em->getRepository('HVGSystemBundle:Guest')->findAll();
        $paginator = $this->get('knp_paginator');
        $guests = $paginator->paginate($guests, $request->query->getInt('page', 1), 100);
        $guest = new Guest();
        $newForm = $this->createNewForm($guest)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($guests as $key => $guest) {
            $editForms[] = $this->createEditForm($guest)->createView();
            $deleteForms[] = $this->createDeleteForm($guest)->createView();
        }

        return $this->render('guest/index.html.twig', array(
            'guests' => $guests,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Guest entity.
     *
     */
    public function newAction(Request $request)
    {
        $guest = new Guest();
        $newForm = $this->createNewForm($guest);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($guest);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'guest.flash.created' );
            } else {
                return $this->render('guest/new.html.twig', array(
                    'guest' => $guest,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('guest_index'));
    }

    /**
     * Creates a form to create a new Guest entity.
     *
     * @param Guest $guest The Guest entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Guest $guest)
    {
        return $this->createForm('HVG\SystemBundle\Form\GuestType', $guest, array(
            'action' => $this->generateUrl('guest_new'),
        ));
    }

    /**
     * Finds and displays a Guest entity.
     *
     */
    public function showAction(Guest $guest)
    {
        $editForm = $this->createEditForm($guest);
        $deleteForm = $this->createDeleteForm($guest);

        return $this->render('guest/show.html.twig', array(
            'guest' => $guest,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Guest entity.
     *
     */
    public function editAction(Request $request, Guest $guest)
    {
        $editForm = $this->createEditForm($guest);
        $deleteForm = $this->createDeleteForm($guest);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($guest);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'guest.flash.updated' );
            } else {
                return $this->render('guest/edit.html.twig', array(
                    'guest' => $guest,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('guest_index'));
    }

    /**
     * Creates a form to edit a Guest entity.
     *
     * @param Guest $guest The Guest entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Guest $guest)
    {
        return $this->createForm('HVG\SystemBundle\Form\GuestType', $guest, array(
            'action' => $this->generateUrl('guest_edit', array('id' => $guest->getId())),
        ));
    }

    /**
     * Deletes a Guest entity.
     *
     */
    public function deleteAction(Request $request, Guest $guest)
    {
        $deleteForm = $this->createDeleteForm($guest);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($guest);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'guest.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('guest_index'));
    }

    /**
     * Creates a form to delete a Guest entity.
     *
     * @param Guest $guest The Guest entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Guest $guest)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('guest_delete', array('id' => $guest->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
