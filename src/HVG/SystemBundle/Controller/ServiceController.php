<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Service;
use HVG\SystemBundle\Form\ServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Service controller.
 *
 */
class ServiceController extends Controller
{

    /**
     * Lists all Service entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $services = $em->getRepository('HVGSystemBundle:Service')->findBy(array(), array($sort => $direction));
        else $services = $em->getRepository('HVGSystemBundle:Service')->findAll();
        $paginator = $this->get('knp_paginator');
        $services = $paginator->paginate($services, $request->query->getInt('page', 1), 100);
        $service = new Service();
        $newForm = $this->createNewForm($service)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($services as $key => $service) {
            $editForms[] = $this->createEditForm($service)->createView();
            $deleteForms[] = $this->createDeleteForm($service)->createView();
        }

        return $this->render('service/index.html.twig', array(
            'services' => $services,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Service entity.
     *
     */
    public function newAction(Request $request)
    {
        $service = new Service();
        $newForm = $this->createNewForm($service);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($service);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'service.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new Service entity.
     *
     * @param Service $service The Service entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Service $service)
    {
        return $this->createForm('HVG\SystemBundle\Form\ServiceType', $service, array(
            'action' => $this->generateUrl('service_new'),
        ));
    }

    /**
     * Finds and displays a Service entity.
     *
     */
    public function showAction(Service $service)
    {
        $editForm = $this->createEditForm($service);
        $deleteForm = $this->createDeleteForm($service);

        return $this->render('service/show.html.twig', array(
            'service' => $service,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Service entity.
     *
     */
    public function editAction(Request $request, Service $service)
    {
        $editForm = $this->createEditForm($service);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($service);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'service.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a Service entity.
     *
     * @param Service $service The Service entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Service $service)
    {
        return $this->createForm('HVG\SystemBundle\Form\ServiceType', $service, array(
            'action' => $this->generateUrl('service_edit', array('id' => $service->getId())),
        ));
    }

    /**
     * Deletes a Service entity.
     *
     */
    public function deleteAction(Request $request, Service $service)
    {
        $deleteForm = $this->createDeleteForm($service);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($service);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'service.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a Service entity.
     *
     * @param Service $service The Service entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Service $service)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('service_delete', array('id' => $service->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
