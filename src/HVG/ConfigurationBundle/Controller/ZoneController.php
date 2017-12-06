<?php

namespace HVG\ConfigurationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use HVG\SystemBundle\Entity\Zone;
use HVG\ConfigurationBundle\Form\ZoneType;

class ZoneController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $sort = $request->query->has('sort') ? $request->query->get('sort') : 'createdAt';
        $direction = $request->query->has('direction') ? $request->query->get('direction') : 'DESC';

        $zones = $em->getRepository('HVGSystemBundle:Zone')->findAll();

        $paginator = $this->get('knp_paginator');
        $zones = $paginator->paginate($zones, $request->query->getInt('page', 1), 100);

        return $this->render('HVGConfigurationBundle:Zone:index.html.twig', array(
            'zones' => $zones,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function newAction(Request $request)
    {
        $zone = new Zone();
        $newForm = $this->createForm(new ZoneType(), $zone);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($zone);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'zone.new.flash' );
                return $this->redirect($this->generateUrl('configuration_zone_show', array('id' => $zone->getId())));
            }
        }

        return $this->render('HVGConfigurationBundle:Zone:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    public function showAction(Zone $zone)
    {
        return $this->render('HVGConfigurationBundle:Zone:show.html.twig', array(
            'zone' => $zone,
        ));
    }

    public function editAction(Request $request, Zone $zone)
    {
        $editForm = $this->createForm(new ZoneType(), $zone);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($zone);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'zone.edit.flash' );
                return $this->redirect($this->generateUrl('configuration_zone_show', array('id' => $zone->getId())));
            }
        }

        return $this->render('HVGConfigurationBundle:Zone:edit.html.twig', array(
            'editForm' => $editForm->createView(),
        ));
    }

    public function deleteAction(Request $request, Zone $zone)
    {
        $deleteForm = $this->createFormBuilder()->setMethod('DELETE')->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted()) {
            if($deleteForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($zone);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'danger', 'zone.delete.flash' );
                return $this->redirect($this->generateUrl('configuration_zone_index'));
            }
        }

        return $this->render('HVGConfigurationBundle:Zone:delete.html.twig', array(
            'zone' => $zone,
            'deleteForm' => $deleteForm->createView(),
        ));
    }

}
