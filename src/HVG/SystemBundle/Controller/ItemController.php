<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Item;
use HVG\SystemBundle\Form\ItemType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Item controller.
 *
 */
class ItemController extends Controller
{

    /**
     * Lists all Item entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $items = $em->getRepository('HVGSystemBundle:Item')->findBy(array(), array($sort => $direction));
        else $items = $em->getRepository('HVGSystemBundle:Item')->findAll();
        $paginator = $this->get('knp_paginator');
        $items = $paginator->paginate($items, $request->query->getInt('page', 1), 100);
        $item = new Item();
        $newForm = $this->createNewForm($item)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($items as $key => $item) {
            $editForms[] = $this->createEditForm($item)->createView();
            $deleteForms[] = $this->createDeleteForm($item)->createView();
        }

        return $this->render('item/index.html.twig', array(
            'items' => $items,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Item entity.
     *
     */
    public function newAction(Request $request)
    {
        $item = new Item();
        $newForm = $this->createNewForm($item);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($item);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'item.flash.created' );
            } else {
                return $this->render('item/new.html.twig', array(
                    'item' => $item,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('item_index'));
    }

    /**
     * Creates a form to create a new Item entity.
     *
     * @param Item $item The Item entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Item $item)
    {
        return $this->createForm('HVG\SystemBundle\Form\ItemType', $item, array(
            'action' => $this->generateUrl('item_new'),
        ));
    }

    /**
     * Finds and displays a Item entity.
     *
     */
    public function showAction(Item $item)
    {
        $editForm = $this->createEditForm($item);
        $deleteForm = $this->createDeleteForm($item);

        return $this->render('item/show.html.twig', array(
            'item' => $item,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Item entity.
     *
     */
    public function editAction(Request $request, Item $item)
    {
        $editForm = $this->createEditForm($item);
        $deleteForm = $this->createDeleteForm($item);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($item);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'item.flash.updated' );
            } else {
                return $this->render('item/edit.html.twig', array(
                    'item' => $item,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('item_index'));
    }

    /**
     * Creates a form to edit a Item entity.
     *
     * @param Item $item The Item entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Item $item)
    {
        return $this->createForm('HVG\SystemBundle\Form\ItemType', $item, array(
            'action' => $this->generateUrl('item_edit', array('id' => $item->getId())),
        ));
    }

    /**
     * Deletes a Item entity.
     *
     */
    public function deleteAction(Request $request, Item $item)
    {
        $deleteForm = $this->createDeleteForm($item);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($item);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'item.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('item_index'));
    }

    /**
     * Creates a form to delete a Item entity.
     *
     * @param Item $item The Item entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Item $item)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('item_delete', array('id' => $item->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
