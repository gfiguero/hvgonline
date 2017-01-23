<?php

namespace HVG\SystemBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Form\CommunityType;

use HVG\SystemBundle\Entity\Filter;

class CommunityController extends Controller
{
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $communities = $em->getRepository('HVGSystemBundle:Community')->findBy(array(), array($sort => $direction));
        else $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();
        $paginator = $this->get('knp_paginator');
        $communities = $paginator->paginate($communities, $request->query->getInt('page', 1), 24);

        $deleteForms = array();
        $editForms = array();
        $community = new Community();
        $newForm = $this->createForm('HVG\SystemBundle\Form\CommunityType', $community, array(
            'action' => $this->generateUrl('community_new'),
        ))->createView();

        foreach ($communities as $key => $community) {
            $editForms[] = $this->createForm('HVG\SystemBundle\Form\CommunityType', $community, array(
                'action' => $this->generateUrl('community_edit', array('id' => $community->getId())),
            ))->createView();
            $deleteForms[] = $this->createDeleteForm($community, array(
                'action' => $this->generateUrl('community_delete', array('id' => $community->getId())),
            ))->createView();
        }

        return $this->render('HVGSystemBundle:Community:index.html.twig', array(
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
        $form = $this->createForm('HVG\SystemBundle\Form\CommunityType', $community);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($community);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'community.new.flash' );

        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Displays a form to edit an existing Community entity.
     *
     */
    public function editAction(Request $request, Community $community)
    {
        $deleteForm = $this->createDeleteForm($community);
        $editForm = $this->createForm('HVG\SystemBundle\Form\CommunityType', $community);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($community);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'community.edit.flash' );

            return $this->redirect($request->headers->get('referer'));
        }

        return $this->render('community/edit.html.twig', array(
            'community' => $community,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Community entity.
     *
     */
    public function deleteAction(Request $request, Community $community)
    {
        $form = $this->createDeleteForm($community);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($community);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'community.delete.flash' );
        }

        return $this->redirect($request->headers->get('referer'));
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

    public function filterAction(Request $request)
    {
        $filter = new Filter();
        $form = $this->createForm('HVG\SystemBundle\Form\FilterType', $filter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $request->getSession()->set('community', $filter->getCommunity());
        }

        return $this->redirect($request->headers->get('referer'));
    }

}
