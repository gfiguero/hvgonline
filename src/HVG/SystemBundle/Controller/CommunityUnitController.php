<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\CommunityUnit;
use HVG\SystemBundle\Form\CommunityUnitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Communityunit controller.
 *
 */
class CommunityUnitController extends Controller
{

    /**
     * Lists all CommunityUnit entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $communityUnits = $em->getRepository('HVGSystemBundle:CommunityUnit')->findBy(array(), array($sort => $direction));
        else $communityUnits = $em->getRepository('HVGSystemBundle:CommunityUnit')->findAll();
        $paginator = $this->get('knp_paginator');
        $communityUnits = $paginator->paginate($communityUnits, $request->query->getInt('page', 1), 30);
        $communityUnit = new CommunityUnit();
        $newForm = $this->createNewForm($communityUnit)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($communityUnits as $key => $communityUnit) {
            $editForms[] = $this->createEditForm($communityUnit)->createView();
            $deleteForms[] = $this->createDeleteForm($communityUnit)->createView();
        }

        return $this->render('communityunit/index.html.twig', array(
            'communityUnits' => $communityUnits,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new CommunityUnit entity.
     *
     */
    public function newAction(Request $request)
    {
        $communityUnit = new CommunityUnit();
        $newForm = $this->createNewForm($communityUnit);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($communityUnit);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'communityUnit.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new CommunityUnit entity.
     *
     * @param CommunityUnit $communityUnit The CommunityUnit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(CommunityUnit $communityUnit)
    {
        return $this->createForm('HVG\SystemBundle\Form\CommunityUnitType', $communityUnit, array(
            'action' => $this->generateUrl('communityunit_new'),
        ));
    }

    /**
     * Finds and displays a CommunityUnit entity.
     *
     */
    public function showAction(CommunityUnit $communityUnit)
    {
        $editForm = $this->createEditForm($communityUnit);
        $deleteForm = $this->createDeleteForm($communityUnit);

        return $this->render('communityunit/show.html.twig', array(
            'communityUnit' => $communityUnit,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CommunityUnit entity.
     *
     */
    public function editAction(Request $request, CommunityUnit $communityUnit)
    {
        $editForm = $this->createEditForm($communityUnit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($communityUnit);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'communityUnit.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a CommunityUnit entity.
     *
     * @param CommunityUnit $communityUnit The CommunityUnit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(CommunityUnit $communityUnit)
    {
        return $this->createForm('HVG\SystemBundle\Form\CommunityUnitType', $communityUnit, array(
            'action' => $this->generateUrl('communityunit_edit', array('id' => $communityUnit->getId())),
        ));
    }

    /**
     * Deletes a CommunityUnit entity.
     *
     */
    public function deleteAction(Request $request, CommunityUnit $communityUnit)
    {
        $deleteForm = $this->createDeleteForm($communityUnit);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($communityUnit);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'communityUnit.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a CommunityUnit entity.
     *
     * @param CommunityUnit $communityUnit The CommunityUnit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CommunityUnit $communityUnit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('communityunit_delete', array('id' => $communityUnit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
