<?php

namespace HVG\ConfigurationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use HVG\SystemBundle\Entity\AccessGuard;
use HVG\ConfigurationBundle\Form\AccessGuardType;

class AccessGuardController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $sort = $request->query->has('sort') ? $request->query->get('sort') : 'createdAt';
        $direction = $request->query->has('direction') ? $request->query->get('direction') : 'DESC';

        $accessguards = $em->getRepository('HVGSystemBundle:AccessGuard')->findAll();

        $paginator = $this->get('knp_paginator');
        $accessguards = $paginator->paginate($accessguards, $request->query->getInt('page', 1), 100);

        return $this->render('HVGConfigurationBundle:AccessGuard:index.html.twig', array(
            'accessguards' => $accessguards,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function newAction(Request $request)
    {
        $accessguard = new AccessGuard();
        $newForm = $this->createForm(new AccessGuardType(), $accessguard);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($accessguard);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'accessguard.new.flash' );
                return $this->redirect($this->generateUrl('configuration_accessguard_index'));
            }
        }

        return $this->render('HVGConfigurationBundle:AccessGuard:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    public function showAction(AccessGuard $accessguard)
    {
        return $this->render('HVGConfigurationBundle:AccessGuard:show.html.twig', array(
            'accessguard' => $accessguard,
        ));
    }

    public function editAction(Request $request, AccessGuard $accessguard)
    {
        $editForm = $this->createForm(new AccessGuardType(), $accessguard);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($accessguard);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'accessguard.edit.flash' );
                return $this->redirect($this->generateUrl('configuration_accessguard_index'));
            }
        }

        return $this->render('HVGConfigurationBundle:AccessGuard:edit.html.twig', array(
            'editForm' => $editForm->createView(),
        ));
    }

    public function deleteAction(Request $request, AccessGuard $accessguard)
    {
        $deleteForm = $this->createFormBuilder()->setMethod('DELETE')->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted()) {
            if($deleteForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($accessguard);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'danger', 'accessguard.delete.flash' );
                return $this->redirect($this->generateUrl('configuration_accessguard_index'));
            }
        }

        return $this->render('HVGConfigurationBundle:AccessGuard:delete.html.twig', array(
            'accessguard' => $accessguard,
            'deleteForm' => $deleteForm->createView(),
        ));
    }

}
