<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Carpark;
use HVG\SystemBundle\Form\CarparkType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Carpark controller.
 *
 */
class CarparkController extends Controller
{

    /**
     * Lists all Carpark entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $carparks = $em->getRepository('HVGSystemBundle:Carpark')->findBy(array(), array($sort => $direction));
        else $carparks = $em->getRepository('HVGSystemBundle:Carpark')->findAll();
        $paginator = $this->get('knp_paginator');
        $carparks = $paginator->paginate($carparks, $request->query->getInt('page', 1), 100);
        $carpark = new Carpark();
        $newForm = $this->createNewForm($carpark)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($carparks as $key => $carpark) {
            $editForms[] = $this->createEditForm($carpark)->createView();
            $deleteForms[] = $this->createDeleteForm($carpark)->createView();
        }

        return $this->render('carpark/index.html.twig', array(
            'carparks' => $carparks,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Carpark entity.
     *
     */
    public function newAction(Request $request)
    {
        $carpark = new Carpark();
        $newForm = $this->createNewForm($carpark);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($carpark);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'carpark.flash.created' );
            } else {
                return $this->render('carpark/new.html.twig', array(
                    'carpark' => $carpark,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('carpark_index'));
    }

    /**
     * Creates a form to create a new Carpark entity.
     *
     * @param Carpark $carpark The Carpark entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Carpark $carpark)
    {
        return $this->createForm('HVG\SystemBundle\Form\CarparkType', $carpark, array(
            'action' => $this->generateUrl('carpark_new'),
        ));
    }

    /**
     * Finds and displays a Carpark entity.
     *
     */
    public function showAction(Carpark $carpark)
    {
        $editForm = $this->createEditForm($carpark);
        $deleteForm = $this->createDeleteForm($carpark);

        return $this->render('carpark/show.html.twig', array(
            'carpark' => $carpark,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Carpark entity.
     *
     */
    public function editAction(Request $request, Carpark $carpark)
    {
        $editForm = $this->createEditForm($carpark);
        $deleteForm = $this->createDeleteForm($carpark);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($carpark);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'carpark.flash.updated' );
            } else {
                return $this->render('carpark/edit.html.twig', array(
                    'carpark' => $carpark,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('carpark_index'));
    }

    /**
     * Creates a form to edit a Carpark entity.
     *
     * @param Carpark $carpark The Carpark entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Carpark $carpark)
    {
        return $this->createForm('HVG\SystemBundle\Form\CarparkType', $carpark, array(
            'action' => $this->generateUrl('carpark_edit', array('id' => $carpark->getId())),
        ));
    }

    /**
     * Deletes a Carpark entity.
     *
     */
    public function deleteAction(Request $request, Carpark $carpark)
    {
        $deleteForm = $this->createDeleteForm($carpark);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($carpark);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'carpark.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('carpark_index'));
    }

    /**
     * Creates a form to delete a Carpark entity.
     *
     * @param Carpark $carpark The Carpark entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Carpark $carpark)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('carpark_delete', array('id' => $carpark->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
