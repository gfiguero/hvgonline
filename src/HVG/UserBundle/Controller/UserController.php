<?php

namespace HVG\UserBundle\Controller;

use HVG\UserBundle\Entity\User;
use HVG\UserBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Model\UserInterface;

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

        return $this->render('HVGUserBundle:User:index.html.twig', array(
            'users' => $users,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function showAction(User $user)
    {
        return $this->render('HVGUserBundle:User:show.html.twig', array(
            'user' => $user,
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
            return $this->redirect($this->generateUrl('user_show', array('id' => $user->getId())));
        }

        return $this->render('HVGUserBundle:User:edit.html.twig', array(
            'editForm' => $editForm->createView(),
        ));
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
