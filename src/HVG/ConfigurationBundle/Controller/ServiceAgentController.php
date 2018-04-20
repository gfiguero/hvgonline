<?php

namespace HVG\ConfigurationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use HVG\SystemBundle\Entity\ServiceAgent;
use HVG\ConfigurationBundle\Form\ServiceAgentType;

class ServiceAgentController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $sort = $request->query->has('sort') ? $request->query->get('sort') : 'createdAt';
        $direction = $request->query->has('direction') ? $request->query->get('direction') : 'DESC';

        $serviceagents = $em->getRepository('HVGSystemBundle:ServiceAgent')->findAll();

        $paginator = $this->get('knp_paginator');
        $serviceagents = $paginator->paginate($serviceagents, $request->query->getInt('page', 1), 100);

        return $this->render('HVGConfigurationBundle:ServiceAgent:index.html.twig', array(
            'serviceagents' => $serviceagents,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function newAction(Request $request)
    {
        $serviceagent = new ServiceAgent();
        $newForm = $this->createForm(new ServiceAgentType(), $serviceagent);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($serviceagent);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'serviceagent.new.flash' );
                return $this->redirect($this->generateUrl('configuration_serviceagent_index'));
            }
        }

        return $this->render('HVGConfigurationBundle:ServiceAgent:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    public function showAction(ServiceAgent $serviceagent)
    {
        return $this->render('HVGConfigurationBundle:ServiceAgent:show.html.twig', array(
            'serviceagent' => $serviceagent,
        ));
    }

    public function editAction(Request $request, ServiceAgent $serviceagent)
    {
        $editForm = $this->createForm(new ServiceAgentType(), $serviceagent);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($serviceagent);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'serviceagent.edit.flash' );
                return $this->redirect($this->generateUrl('configuration_serviceagent_index'));
            }
        }

        return $this->render('HVGConfigurationBundle:ServiceAgent:edit.html.twig', array(
            'editForm' => $editForm->createView(),
        ));
    }

    public function deleteAction(Request $request, ServiceAgent $serviceagent)
    {
        $deleteForm = $this->createFormBuilder()->setMethod('DELETE')->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted()) {
            if($deleteForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($serviceagent);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'danger', 'serviceagent.delete.flash' );
                return $this->redirect($this->generateUrl('configuration_serviceagent_index'));
            }
        }

        return $this->render('HVGConfigurationBundle:ServiceAgent:delete.html.twig', array(
            'serviceagent' => $serviceagent,
            'deleteForm' => $deleteForm->createView(),
        ));
    }

}
