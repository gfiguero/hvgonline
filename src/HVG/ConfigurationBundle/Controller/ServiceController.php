<?php

namespace HVG\ConfigurationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use HVG\SystemBundle\Entity\Service;
use HVG\ConfigurationBundle\Form\ServiceType;

class ServiceController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $sort = $request->query->has('sort') ? $request->query->get('sort') : 'createdAt';
        $direction = $request->query->has('direction') ? $request->query->get('direction') : 'DESC';

        $services = $em->getRepository('HVGSystemBundle:Service')->findAll();

        $paginator = $this->get('knp_paginator');
        $services = $paginator->paginate($services, $request->query->getInt('page', 1), 100);

        return $this->render('HVGConfigurationBundle:Service:index.html.twig', array(
            'services' => $services,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function newAction(Request $request)
    {
        $service = new Service();
        $newForm = $this->createForm(new ServiceType(), $service);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($service);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'service.new.flash' );
                return $this->redirect($this->generateUrl('configuration_service_index'));
            }
        }

        return $this->render('HVGConfigurationBundle:Service:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    public function showAction(Service $service)
    {
        return $this->render('HVGConfigurationBundle:Service:show.html.twig', array(
            'service' => $service,
        ));
    }

    public function editAction(Request $request, Service $service)
    {
        $editForm = $this->createForm(new ServiceType(), $service);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($service);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'service.edit.flash' );
                return $this->redirect($this->generateUrl('configuration_service_index'));
            }
        }

        return $this->render('HVGConfigurationBundle:Service:edit.html.twig', array(
            'editForm' => $editForm->createView(),
        ));
    }

    public function deleteAction(Request $request, Service $service)
    {
        $deleteForm = $this->createFormBuilder()->setMethod('DELETE')->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted()) {
            if($deleteForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($service);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'danger', 'service.delete.flash' );
                return $this->redirect($this->generateUrl('configuration_service_index'));
            }
        }

        return $this->render('HVGConfigurationBundle:Service:delete.html.twig', array(
            'service' => $service,
            'deleteForm' => $deleteForm->createView(),
        ));
    }

}
