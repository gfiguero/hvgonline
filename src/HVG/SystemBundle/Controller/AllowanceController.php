<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Allowance;
use HVG\SystemBundle\Form\AllowanceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Allowance controller.
 *
 */
class AllowanceController extends Controller
{

    /**
     * Lists all Allowance entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $allowances = $em->getRepository('HVGSystemBundle:Allowance')->findBy(array(), array($sort => $direction));
        else $allowances = $em->getRepository('HVGSystemBundle:Allowance')->findAll();
        $paginator = $this->get('knp_paginator');
        $allowances = $paginator->paginate($allowances, $request->query->getInt('page', 1), 100);
        $allowance = new Allowance();
        $newForm = $this->createNewForm($allowance)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($allowances as $key => $allowance) {
            $editForms[] = $this->createEditForm($allowance)->createView();
            $deleteForms[] = $this->createDeleteForm($allowance)->createView();
        }

        return $this->render('allowance/index.html.twig', array(
            'allowances' => $allowances,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Allowance entity.
     *
     */
    public function newAction(Request $request)
    {
        $allowance = new Allowance();
        $newForm = $this->createNewForm($allowance);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($allowance);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'allowance.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new Allowance entity.
     *
     * @param Allowance $allowance The Allowance entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Allowance $allowance)
    {
        return $this->createForm('HVG\SystemBundle\Form\AllowanceType', $allowance, array(
            'action' => $this->generateUrl('allowance_new'),
        ));
    }

    /**
     * Finds and displays a Allowance entity.
     *
     */
    public function showAction(Allowance $allowance)
    {
        $editForm = $this->createEditForm($allowance);
        $deleteForm = $this->createDeleteForm($allowance);

        return $this->render('allowance/show.html.twig', array(
            'allowance' => $allowance,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Allowance entity.
     *
     */
    public function editAction(Request $request, Allowance $allowance)
    {
        $editForm = $this->createEditForm($allowance);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($allowance);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'allowance.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a Allowance entity.
     *
     * @param Allowance $allowance The Allowance entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Allowance $allowance)
    {
        return $this->createForm('HVG\SystemBundle\Form\AllowanceType', $allowance, array(
            'action' => $this->generateUrl('allowance_edit', array('id' => $allowance->getId())),
        ));
    }

    /**
     * Deletes a Allowance entity.
     *
     */
    public function deleteAction(Request $request, Allowance $allowance)
    {
        $deleteForm = $this->createDeleteForm($allowance);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($allowance);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'allowance.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a Allowance entity.
     *
     * @param Allowance $allowance The Allowance entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Allowance $allowance)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('allowance_delete', array('id' => $allowance->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
