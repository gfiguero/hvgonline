<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\UnitMemo;
use HVG\SystemBundle\Form\UnitMemoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Unitmemo controller.
 *
 */
class UnitMemoController extends Controller
{

    /**
     * Lists all UnitMemo entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $unitMemos = $em->getRepository('HVGSystemBundle:UnitMemo')->findBy(array(), array($sort => $direction));
        else $unitMemos = $em->getRepository('HVGSystemBundle:UnitMemo')->findAll();
        $paginator = $this->get('knp_paginator');
        $unitMemos = $paginator->paginate($unitMemos, $request->query->getInt('page', 1), 100);
        $unitMemo = new UnitMemo();
        $newForm = $this->createNewForm($unitMemo)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($unitMemos as $key => $unitMemo) {
            $editForms[] = $this->createEditForm($unitMemo)->createView();
            $deleteForms[] = $this->createDeleteForm($unitMemo)->createView();
        }

        return $this->render('unitmemo/index.html.twig', array(
            'unitMemos' => $unitMemos,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new UnitMemo entity.
     *
     */
    public function newAction(Request $request)
    {
        $unitMemo = new UnitMemo();
        $newForm = $this->createNewForm($unitMemo);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($unitMemo);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'unitMemo.flash.created' );
            } else {
                return $this->render('unitmemo/new.html.twig', array(
                    'unitMemo' => $unitMemo,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('unitmemo_index'));
    }

    /**
     * Creates a form to create a new UnitMemo entity.
     *
     * @param UnitMemo $unitMemo The UnitMemo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(UnitMemo $unitMemo)
    {
        return $this->createForm('HVG\SystemBundle\Form\UnitMemoType', $unitMemo, array(
            'action' => $this->generateUrl('unitmemo_new'),
        ));
    }

    /**
     * Finds and displays a UnitMemo entity.
     *
     */
    public function showAction(UnitMemo $unitMemo)
    {
        $editForm = $this->createEditForm($unitMemo);
        $deleteForm = $this->createDeleteForm($unitMemo);

        return $this->render('unitmemo/show.html.twig', array(
            'unitMemo' => $unitMemo,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing UnitMemo entity.
     *
     */
    public function editAction(Request $request, UnitMemo $unitMemo)
    {
        $editForm = $this->createEditForm($unitMemo);
        $deleteForm = $this->createDeleteForm($unitMemo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($unitMemo);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'unitMemo.flash.updated' );
            } else {
                return $this->render('unitmemo/edit.html.twig', array(
                    'unitMemo' => $unitMemo,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('unitmemo_index'));
    }

    /**
     * Creates a form to edit a UnitMemo entity.
     *
     * @param UnitMemo $unitMemo The UnitMemo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(UnitMemo $unitMemo)
    {
        return $this->createForm('HVG\SystemBundle\Form\UnitMemoType', $unitMemo, array(
            'action' => $this->generateUrl('unitmemo_edit', array('id' => $unitMemo->getId())),
        ));
    }

    /**
     * Deletes a UnitMemo entity.
     *
     */
    public function deleteAction(Request $request, UnitMemo $unitMemo)
    {
        $deleteForm = $this->createDeleteForm($unitMemo);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($unitMemo);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'unitMemo.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('unitmemo_index'));
    }

    /**
     * Creates a form to delete a UnitMemo entity.
     *
     * @param UnitMemo $unitMemo The UnitMemo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UnitMemo $unitMemo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('unitmemo_delete', array('id' => $unitMemo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
