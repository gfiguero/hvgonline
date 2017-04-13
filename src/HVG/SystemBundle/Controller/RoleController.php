<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Role;
use HVG\SystemBundle\Form\RoleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Role controller.
 *
 */
class RoleController extends Controller
{

    /**
     * Lists all Role entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $roles = $em->getRepository('HVGSystemBundle:Role')->findBy(array(), array($sort => $direction));
        else $roles = $em->getRepository('HVGSystemBundle:Role')->findAll();
        $paginator = $this->get('knp_paginator');
        $roles = $paginator->paginate($roles, $request->query->getInt('page', 1), 100);
        $role = new Role();
        $newForm = $this->createNewForm($role)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($roles as $key => $role) {
            $editForms[] = $this->createEditForm($role)->createView();
            $deleteForms[] = $this->createDeleteForm($role)->createView();
        }

        return $this->render('role/index.html.twig', array(
            'roles' => $roles,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Role entity.
     *
     */
    public function newAction(Request $request)
    {
        $role = new Role();
        $newForm = $this->createNewForm($role);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($role);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'role.flash.created' );
            } else {
                return $this->render('role/new.html.twig', array(
                    'role' => $role,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('role_index'));
    }

    /**
     * Creates a form to create a new Role entity.
     *
     * @param Role $role The Role entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Role $role)
    {
        return $this->createForm('HVG\SystemBundle\Form\RoleType', $role, array(
            'action' => $this->generateUrl('role_new'),
        ));
    }

    /**
     * Finds and displays a Role entity.
     *
     */
    public function showAction(Role $role)
    {
        $editForm = $this->createEditForm($role);
        $deleteForm = $this->createDeleteForm($role);

        return $this->render('role/show.html.twig', array(
            'role' => $role,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Role entity.
     *
     */
    public function editAction(Request $request, Role $role)
    {
        $editForm = $this->createEditForm($role);
        $deleteForm = $this->createDeleteForm($role);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($role);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'role.flash.updated' );
            } else {
                return $this->render('role/edit.html.twig', array(
                    'role' => $role,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('role_index'));
    }

    /**
     * Creates a form to edit a Role entity.
     *
     * @param Role $role The Role entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Role $role)
    {
        return $this->createForm('HVG\SystemBundle\Form\RoleType', $role, array(
            'action' => $this->generateUrl('role_edit', array('id' => $role->getId())),
        ));
    }

    /**
     * Deletes a Role entity.
     *
     */
    public function deleteAction(Request $request, Role $role)
    {
        $deleteForm = $this->createDeleteForm($role);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($role);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'role.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('role_index'));
    }

    /**
     * Creates a form to delete a Role entity.
     *
     * @param Role $role The Role entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Role $role)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('role_delete', array('id' => $role->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
