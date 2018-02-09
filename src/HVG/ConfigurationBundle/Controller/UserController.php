<?php

namespace HVG\ConfigurationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use HVG\UserBundle\Entity\User;
use HVG\ConfigurationBundle\Form\UserType;
use HVG\ConfigurationBundle\Form\RegistrationType;

class UserController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $sort = $request->query->has('sort') ? $request->query->get('sort') : 'createdAt';
        $direction = $request->query->has('direction') ? $request->query->get('direction') : 'DESC';

        $users = $em->getRepository('HVGUserBundle:User')->findAll();

        $paginator = $this->get('knp_paginator');
        $users = $paginator->paginate($users, $request->query->getInt('page', 1), 100);

        return $this->render('HVGConfigurationBundle:User:index.html.twig', array(
            'users' => $users,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function newAction(Request $request)
    {
        $user = new User();
        $newForm = $this->createForm(new RegistrationType(), $user);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'user.new.flash' );
                return $this->redirect($this->generateUrl('configuration_user_show', array('id' => $user->getId())));
            }
        }

        return $this->render('HVGConfigurationBundle:User:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    public function showAction(User $user)
    {
        return $this->render('HVGConfigurationBundle:User:show.html.twig', array(
            'user' => $user,
        ));
    }

    public function editAction(Request $request, User $user)
    {
        $editForm = $this->createForm(new UserType(), $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'user.edit.flash' );
                return $this->redirect($this->generateUrl('configuration_user_show', array('id' => $user->getId())));
            }
        }

        return $this->render('HVGConfigurationBundle:User:edit.html.twig', array(
            'editForm' => $editForm->createView(),
        ));
    }

    public function deleteAction(Request $request, User $user)
    {
        $deleteForm = $this->createFormBuilder()->setMethod('DELETE')->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted()) {
            if($deleteForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($user);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'danger', 'user.delete.flash' );
                return $this->redirect($this->generateUrl('configuration_user_index'));
            }
        }

        return $this->render('HVGConfigurationBundle:User:delete.html.twig', array(
            'user' => $user,
            'deleteForm' => $deleteForm->createView(),
        ));
    }

}
