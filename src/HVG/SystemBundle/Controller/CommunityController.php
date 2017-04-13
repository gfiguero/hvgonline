<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Form\CommunityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Community controller.
 *
 */
class CommunityController extends Controller
{

    /**
     * Lists all Community entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $communities = $em->getRepository('HVGSystemBundle:Community')->findBy(array(), array($sort => $direction));
        else $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();
        $paginator = $this->get('knp_paginator');
        $communities = $paginator->paginate($communities, $request->query->getInt('page', 1), 100);
        $community = new Community();
        $newForm = $this->createNewForm($community)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($communities as $key => $community) {
            $editForms[] = $this->createEditForm($community)->createView();
            $deleteForms[] = $this->createDeleteForm($community)->createView();
        }

        return $this->render('community/index.html.twig', array(
            'communities' => $communities,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Community entity.
     *
     */
    public function newAction(Request $request)
    {
        $community = new Community();
        $newForm = $this->createNewForm($community);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($community);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'community.flash.created' );
            } else {
                return $this->render('community/new.html.twig', array(
                    'community' => $community,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('community_index'));
    }

    /**
     * Creates a form to create a new Community entity.
     *
     * @param Community $community The Community entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Community $community)
    {
        return $this->createForm('HVG\SystemBundle\Form\CommunityType', $community, array(
            'action' => $this->generateUrl('community_new'),
        ));
    }

    /**
     * Finds and displays a Community entity.
     *
     */
    public function showAction(Community $community)
    {
        $editForm = $this->createEditForm($community);
        $deleteForm = $this->createDeleteForm($community);

        return $this->render('community/show.html.twig', array(
            'community' => $community,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Community entity.
     *
     */
    public function editAction(Request $request, Community $community)
    {
        $editForm = $this->createEditForm($community);
        $deleteForm = $this->createDeleteForm($community);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($community);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'community.flash.updated' );
            } else {
                return $this->render('community/edit.html.twig', array(
                    'community' => $community,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('community_index'));
    }

    /**
     * Creates a form to edit a Community entity.
     *
     * @param Community $community The Community entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Community $community)
    {
        return $this->createForm('HVG\SystemBundle\Form\CommunityType', $community, array(
            'action' => $this->generateUrl('community_edit', array('id' => $community->getId())),
        ));
    }

    /**
     * Deletes a Community entity.
     *
     */
    public function deleteAction(Request $request, Community $community)
    {
        $deleteForm = $this->createDeleteForm($community);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($community);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'community.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('community_index'));
    }

    /**
     * Creates a form to delete a Community entity.
     *
     * @param Community $community The Community entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Community $community)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('community_delete', array('id' => $community->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
