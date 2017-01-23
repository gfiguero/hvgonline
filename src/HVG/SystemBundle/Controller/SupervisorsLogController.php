<?php

namespace HVG\SystemBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HVG\SystemBundle\Entity\SupervisorsLog;
use HVG\SystemBundle\Form\SupervisorsLogType;

class SupervisorsLogController extends Controller
{
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $supervisorsLogs = $em->getRepository('HVGSystemBundle:SupervisorsLog')->findBy(array(), array($sort => $direction));
        else $supervisorsLogs = $em->getRepository('HVGSystemBundle:SupervisorsLog')->findBy(array(), array('id' => 'desc'));
        $paginator = $this->get('knp_paginator');
        $supervisorsLogs = $paginator->paginate($supervisorsLogs, $request->query->getInt('page', 1), 24);

        $deleteForms = array();
        $editForms = array();
        $supervisorsLog = new SupervisorsLog();
        $newForm = $this->createForm('HVG\SystemBundle\Form\SupervisorsLogType', $supervisorsLog, array(
            'action' => $this->generateUrl('supervisorslog_new'),
        ))->createView();

        foreach ($supervisorsLogs as $key => $supervisorsLog) {
            $editForms[] = $this->createForm('HVG\SystemBundle\Form\SupervisorsLogType', $supervisorsLog, array(
                'action' => $this->generateUrl('supervisorslog_edit', array('id' => $supervisorsLog->getId())),
            ))->createView();
            $deleteForms[] = $this->createDeleteForm($supervisorsLog, array(
                'action' => $this->generateUrl('supervisorslog_delete', array('id' => $supervisorsLog->getId())),
            ))->createView();
        }

        return $this->render('HVGSystemBundle:SupervisorsLog:index.html.twig', array(
            'supervisorsLogs' => $supervisorsLogs,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new SupervisorsLog entity.
     *
     */
    public function newAction(Request $request)
    {
        $supervisorsLog = new SupervisorsLog();
        $form = $this->createForm('HVG\SystemBundle\Form\SupervisorsLogType', $supervisorsLog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($supervisorsLog);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'supervisorsLog.new.flash' );

        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Displays a form to edit an existing SupervisorsLog entity.
     *
     */
    public function editAction(Request $request, SupervisorsLog $supervisorsLog)
    {
        $deleteForm = $this->createDeleteForm($supervisorsLog);
        $editForm = $this->createForm('HVG\SystemBundle\Form\SupervisorsLogType', $supervisorsLog);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($supervisorsLog);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'supervisorsLog.edit.flash' );

            return $this->redirect($request->headers->get('referer'));
        }

        return $this->render('supervisorsLog/edit.html.twig', array(
            'supervisorsLog' => $supervisorsLog,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SupervisorsLog entity.
     *
     */
    public function deleteAction(Request $request, SupervisorsLog $supervisorsLog)
    {
        $form = $this->createDeleteForm($supervisorsLog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($supervisorsLog);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'supervisorsLog.delete.flash' );
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a SupervisorsLog entity.
     *
     * @param SupervisorsLog $supervisorsLog The SupervisorsLog entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SupervisorsLog $supervisorsLog)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('supervisorslog_delete', array('id' => $supervisorsLog->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
