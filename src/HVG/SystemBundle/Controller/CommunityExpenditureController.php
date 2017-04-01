<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\CommunityExpenditure;
use HVG\SystemBundle\Form\CommunityExpenditureType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Communityexpenditure controller.
 *
 */
class CommunityExpenditureController extends Controller
{

    /**
     * Lists all CommunityExpenditure entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $communityExpenditures = $em->getRepository('HVGSystemBundle:CommunityExpenditure')->findBy(array(), array($sort => $direction));
        else $communityExpenditures = $em->getRepository('HVGSystemBundle:CommunityExpenditure')->findAll();
        $paginator = $this->get('knp_paginator');
        $communityExpenditures = $paginator->paginate($communityExpenditures, $request->query->getInt('page', 1), 30);
        $communityExpenditure = new CommunityExpenditure();
        $newForm = $this->createNewForm($communityExpenditure)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($communityExpenditures as $key => $communityExpenditure) {
            $editForms[] = $this->createEditForm($communityExpenditure)->createView();
            $deleteForms[] = $this->createDeleteForm($communityExpenditure)->createView();
        }

        return $this->render('communityexpenditure/index.html.twig', array(
            'communityExpenditures' => $communityExpenditures,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new CommunityExpenditure entity.
     *
     */
    public function newAction(Request $request)
    {
        $communityExpenditure = new CommunityExpenditure();
        $newForm = $this->createNewForm($communityExpenditure);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($communityExpenditure);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'communityExpenditure.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new CommunityExpenditure entity.
     *
     * @param CommunityExpenditure $communityExpenditure The CommunityExpenditure entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(CommunityExpenditure $communityExpenditure)
    {
        return $this->createForm('HVG\SystemBundle\Form\CommunityExpenditureType', $communityExpenditure, array(
            'action' => $this->generateUrl('communityexpenditure_new'),
        ));
    }

    /**
     * Finds and displays a CommunityExpenditure entity.
     *
     */
    public function showAction(CommunityExpenditure $communityExpenditure)
    {
        $editForm = $this->createEditForm($communityExpenditure);
        $deleteForm = $this->createDeleteForm($communityExpenditure);

        return $this->render('communityexpenditure/show.html.twig', array(
            'communityExpenditure' => $communityExpenditure,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CommunityExpenditure entity.
     *
     */
    public function editAction(Request $request, CommunityExpenditure $communityExpenditure)
    {
        $editForm = $this->createEditForm($communityExpenditure);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($communityExpenditure);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'communityExpenditure.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a CommunityExpenditure entity.
     *
     * @param CommunityExpenditure $communityExpenditure The CommunityExpenditure entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(CommunityExpenditure $communityExpenditure)
    {
        return $this->createForm('HVG\SystemBundle\Form\CommunityExpenditureType', $communityExpenditure, array(
            'action' => $this->generateUrl('communityexpenditure_edit', array('id' => $communityExpenditure->getId())),
        ));
    }

    /**
     * Deletes a CommunityExpenditure entity.
     *
     */
    public function deleteAction(Request $request, CommunityExpenditure $communityExpenditure)
    {
        $deleteForm = $this->createDeleteForm($communityExpenditure);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($communityExpenditure);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'communityExpenditure.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a CommunityExpenditure entity.
     *
     * @param CommunityExpenditure $communityExpenditure The CommunityExpenditure entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CommunityExpenditure $communityExpenditure)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('communityexpenditure_delete', array('id' => $communityExpenditure->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
