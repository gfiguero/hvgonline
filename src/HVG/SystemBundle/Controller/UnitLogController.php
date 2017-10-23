<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\UnitLog;
use HVG\SystemBundle\Form\UnitLogType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Unitlog controller.
 *
 */
class UnitLogController extends Controller
{

    /**
     * Lists all UnitLog entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $unitLogs = $em->getRepository('HVGSystemBundle:UnitLog')->findBy(array(), array($sort => $direction));
        else $unitLogs = $em->getRepository('HVGSystemBundle:UnitLog')->findAll();
        $paginator = $this->get('knp_paginator');
        $unitLogs = $paginator->paginate($unitLogs, $request->query->getInt('page', 1), 100);
        $unitLog = new UnitLog();
        $newForm = $this->createNewForm($unitLog)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($unitLogs as $key => $unitLog) {
            $editForms[] = $this->createEditForm($unitLog)->createView();
            $deleteForms[] = $this->createDeleteForm($unitLog)->createView();
        }

        return $this->render('unitlog/index.html.twig', array(
            'unitLogs' => $unitLogs,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new UnitLog entity.
     *
     */
    public function newAction(Request $request)
    {
        $unitLog = new UnitLog();
        $newForm = $this->createNewForm($unitLog);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($unitLog);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'unitLog.flash.created' );
            } else {
                return $this->render('unitlog/new.html.twig', array(
                    'unitLog' => $unitLog,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('unitlog_index'));
    }

    /**
     * Creates a form to create a new UnitLog entity.
     *
     * @param UnitLog $unitLog The UnitLog entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(UnitLog $unitLog)
    {
        return $this->createForm('HVG\SystemBundle\Form\UnitLogType', $unitLog, array(
            'action' => $this->generateUrl('unitlog_new'),
        ));
    }

    /**
     * Finds and displays a UnitLog entity.
     *
     */
    public function showAction(UnitLog $unitLog)
    {
        $editForm = $this->createEditForm($unitLog);
        $deleteForm = $this->createDeleteForm($unitLog);

        return $this->render('unitlog/show.html.twig', array(
            'unitLog' => $unitLog,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing UnitLog entity.
     *
     */
    public function editAction(Request $request, UnitLog $unitLog)
    {
        $editForm = $this->createEditForm($unitLog);
        $deleteForm = $this->createDeleteForm($unitLog);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($unitLog);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'unitLog.flash.updated' );
            } else {
                return $this->render('unitlog/edit.html.twig', array(
                    'unitLog' => $unitLog,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('unitlog_index'));
    }

    /**
     * Creates a form to edit a UnitLog entity.
     *
     * @param UnitLog $unitLog The UnitLog entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(UnitLog $unitLog)
    {
        return $this->createForm('HVG\SystemBundle\Form\UnitLogType', $unitLog, array(
            'action' => $this->generateUrl('unitlog_edit', array('id' => $unitLog->getId())),
        ));
    }

    /**
     * Deletes a UnitLog entity.
     *
     */
    public function deleteAction(Request $request, UnitLog $unitLog)
    {
        $deleteForm = $this->createDeleteForm($unitLog);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($unitLog);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'unitLog.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('unitlog_index'));
    }

    /**
     * Creates a form to delete a UnitLog entity.
     *
     * @param UnitLog $unitLog The UnitLog entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UnitLog $unitLog)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('unitlog_delete', array('id' => $unitLog->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
