<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Fund;
use HVG\SystemBundle\Form\FundType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Fund controller.
 *
 */
class FundController extends Controller
{

    /**
     * Lists all Fund entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $funds = $em->getRepository('HVGSystemBundle:Fund')->findBy(array(), array($sort => $direction));
        else $funds = $em->getRepository('HVGSystemBundle:Fund')->findAll();
        $paginator = $this->get('knp_paginator');
        $funds = $paginator->paginate($funds, $request->query->getInt('page', 1), 100);
        $fund = new Fund();
        $newForm = $this->createNewForm($fund)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($funds as $key => $fund) {
            $editForms[] = $this->createEditForm($fund)->createView();
            $deleteForms[] = $this->createDeleteForm($fund)->createView();
        }

        return $this->render('fund/index.html.twig', array(
            'funds' => $funds,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Fund entity.
     *
     */
    public function newAction(Request $request)
    {
        $fund = new Fund();
        $newForm = $this->createNewForm($fund);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fund);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'fund.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new Fund entity.
     *
     * @param Fund $fund The Fund entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Fund $fund)
    {
        return $this->createForm('HVG\SystemBundle\Form\FundType', $fund, array(
            'action' => $this->generateUrl('fund_new'),
        ));
    }

    /**
     * Finds and displays a Fund entity.
     *
     */
    public function showAction(Fund $fund)
    {
        $editForm = $this->createEditForm($fund);
        $deleteForm = $this->createDeleteForm($fund);

        return $this->render('fund/show.html.twig', array(
            'fund' => $fund,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Fund entity.
     *
     */
    public function editAction(Request $request, Fund $fund)
    {
        $editForm = $this->createEditForm($fund);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fund);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'fund.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a Fund entity.
     *
     * @param Fund $fund The Fund entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Fund $fund)
    {
        return $this->createForm('HVG\SystemBundle\Form\FundType', $fund, array(
            'action' => $this->generateUrl('fund_edit', array('id' => $fund->getId())),
        ));
    }

    /**
     * Deletes a Fund entity.
     *
     */
    public function deleteAction(Request $request, Fund $fund)
    {
        $deleteForm = $this->createDeleteForm($fund);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fund);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'fund.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a Fund entity.
     *
     * @param Fund $fund The Fund entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Fund $fund)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fund_delete', array('id' => $fund->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
