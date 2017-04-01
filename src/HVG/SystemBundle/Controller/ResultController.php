<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Result;
use HVG\SystemBundle\Form\ResultType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Result controller.
 *
 */
class ResultController extends Controller
{

    /**
     * Lists all Result entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $results = $em->getRepository('HVGSystemBundle:Result')->findBy(array(), array($sort => $direction));
        else $results = $em->getRepository('HVGSystemBundle:Result')->findAll();
        $paginator = $this->get('knp_paginator');
        $results = $paginator->paginate($results, $request->query->getInt('page', 1), 100);
        $result = new Result();
        $newForm = $this->createNewForm($result)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($results as $key => $result) {
            $editForms[] = $this->createEditForm($result)->createView();
            $deleteForms[] = $this->createDeleteForm($result)->createView();
        }

        return $this->render('result/index.html.twig', array(
            'results' => $results,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Result entity.
     *
     */
    public function newAction(Request $request)
    {
        $result = new Result();
        $newForm = $this->createNewForm($result);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($result);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'result.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new Result entity.
     *
     * @param Result $result The Result entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Result $result)
    {
        return $this->createForm('HVG\SystemBundle\Form\ResultType', $result, array(
            'action' => $this->generateUrl('result_new'),
        ));
    }

    /**
     * Finds and displays a Result entity.
     *
     */
    public function showAction(Result $result)
    {
        $editForm = $this->createEditForm($result);
        $deleteForm = $this->createDeleteForm($result);

        return $this->render('result/show.html.twig', array(
            'result' => $result,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Result entity.
     *
     */
    public function editAction(Request $request, Result $result)
    {
        $editForm = $this->createEditForm($result);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($result);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'result.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a Result entity.
     *
     * @param Result $result The Result entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Result $result)
    {
        return $this->createForm('HVG\SystemBundle\Form\ResultType', $result, array(
            'action' => $this->generateUrl('result_edit', array('id' => $result->getId())),
        ));
    }

    /**
     * Deletes a Result entity.
     *
     */
    public function deleteAction(Request $request, Result $result)
    {
        $deleteForm = $this->createDeleteForm($result);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($result);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'result.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a Result entity.
     *
     * @param Result $result The Result entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Result $result)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('result_delete', array('id' => $result->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
