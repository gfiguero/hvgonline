<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\GuestCarpark;
use HVG\SystemBundle\Form\GuestCarparkType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Guestcarpark controller.
 *
 */
class GuestCarparkController extends Controller
{

    /**
     * Lists all GuestCarpark entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $guestCarparks = $em->getRepository('HVGSystemBundle:GuestCarpark')->findBy(array(), array($sort => $direction));
        else $guestCarparks = $em->getRepository('HVGSystemBundle:GuestCarpark')->findAll();
        $paginator = $this->get('knp_paginator');
        $guestCarparks = $paginator->paginate($guestCarparks, $request->query->getInt('page', 1), 100);
        $guestCarpark = new GuestCarpark();
        $newForm = $this->createNewForm($guestCarpark)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($guestCarparks as $key => $guestCarpark) {
            $editForms[] = $this->createEditForm($guestCarpark)->createView();
            $deleteForms[] = $this->createDeleteForm($guestCarpark)->createView();
        }

        return $this->render('guestcarpark/index.html.twig', array(
            'guestCarparks' => $guestCarparks,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new GuestCarpark entity.
     *
     */
    public function newAction(Request $request)
    {
        $guestCarpark = new GuestCarpark();
        $newForm = $this->createNewForm($guestCarpark);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($guestCarpark);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'guestCarpark.flash.created' );
            } else {
                return $this->render('guestcarpark/new.html.twig', array(
                    'guestCarpark' => $guestCarpark,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('guestcarpark_index'));
    }

    /**
     * Creates a form to create a new GuestCarpark entity.
     *
     * @param GuestCarpark $guestCarpark The GuestCarpark entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(GuestCarpark $guestCarpark)
    {
        return $this->createForm('HVG\SystemBundle\Form\GuestCarparkType', $guestCarpark, array(
            'action' => $this->generateUrl('guestcarpark_new'),
        ));
    }

    /**
     * Finds and displays a GuestCarpark entity.
     *
     */
    public function showAction(GuestCarpark $guestCarpark)
    {
        $editForm = $this->createEditForm($guestCarpark);
        $deleteForm = $this->createDeleteForm($guestCarpark);

        return $this->render('guestcarpark/show.html.twig', array(
            'guestCarpark' => $guestCarpark,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing GuestCarpark entity.
     *
     */
    public function editAction(Request $request, GuestCarpark $guestCarpark)
    {
        $editForm = $this->createEditForm($guestCarpark);
        $deleteForm = $this->createDeleteForm($guestCarpark);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($guestCarpark);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'guestCarpark.flash.updated' );
            } else {
                return $this->render('guestcarpark/edit.html.twig', array(
                    'guestCarpark' => $guestCarpark,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('guestcarpark_index'));
    }

    /**
     * Creates a form to edit a GuestCarpark entity.
     *
     * @param GuestCarpark $guestCarpark The GuestCarpark entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(GuestCarpark $guestCarpark)
    {
        return $this->createForm('HVG\SystemBundle\Form\GuestCarparkType', $guestCarpark, array(
            'action' => $this->generateUrl('guestcarpark_edit', array('id' => $guestCarpark->getId())),
        ));
    }

    /**
     * Deletes a GuestCarpark entity.
     *
     */
    public function deleteAction(Request $request, GuestCarpark $guestCarpark)
    {
        $deleteForm = $this->createDeleteForm($guestCarpark);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($guestCarpark);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'guestCarpark.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('guestcarpark_index'));
    }

    /**
     * Creates a form to delete a GuestCarpark entity.
     *
     * @param GuestCarpark $guestCarpark The GuestCarpark entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GuestCarpark $guestCarpark)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('guestcarpark_delete', array('id' => $guestCarpark->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
