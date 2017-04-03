<?php

namespace HVG\UserBundle\Controller;

use HVG\UserBundle\Entity\User;
use HVG\UserBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 */
class UserController extends Controller
{

    /**
     * Lists all User entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $users = $em->getRepository('HVGUserBundle:User')->findBy(array(), array($sort => $direction));
        else $users = $em->getRepository('HVGUserBundle:User')->findAll();
        $paginator = $this->get('knp_paginator');
        $users = $paginator->paginate($users, $request->query->getInt('page', 1), 100);
        $user = new User();
        $newForm = $this->createNewForm($user)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($users as $key => $user) {
            $editForms[] = $this->createEditForm($user)->createView();
            $deleteForms[] = $this->createDeleteForm($user)->createView();
        }

        return $this->render('user/index.html.twig', array(
            'users' => $users,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new User entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $newForm = $this->createNewForm($user);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'user.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new User entity.
     *
     * @param User $user The User entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(User $user)
    {
        return $this->createForm('HVG\UserBundle\Form\UserType', $user, array(
            'action' => $this->generateUrl('user_new'),
        ));
    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function showAction(User $user)
    {
        $editForm = $this->createEditForm($user);
        $deleteForm = $this->createDeleteForm($user);

        return $this->render('user/show.html.twig', array(
            'user' => $user,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction(Request $request, User $user)
    {
        $editForm = $this->createEditForm($user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'user.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a User entity.
     *
     * @param User $user The User entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(User $user)
    {
        return $this->createForm('HVG\UserBundle\Form\UserType', $user, array(
            'action' => $this->generateUrl('user_edit', array('id' => $user->getId())),
        ));
    }

    /**
     * Deletes a User entity.
     *
     */
    public function deleteAction(Request $request, User $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'user.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a User entity.
     *
     * @param User $user The User entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
