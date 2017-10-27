<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\Carpark;

use HVG\AgentBundle\Form\CarparkType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Unitmemo controller.
 *
 */
class CarparkController extends Controller
{
    public function indexAction(Request $request, Community $community = null, UnitGroup $unitgroup = null, Unit $unit = null)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();
        $unitgroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findByCommunity($community);
        $units = $em->getRepository('HVGSystemBundle:Unit')->findByUnitgroup($unitgroup);

        $sort = $request->query->has('sort') ? $request->query->get('sort') : 'createdAt';
        $direction = $request->query->has('direction') ? $request->query->get('direction') : 'DESC';

        if($unit){
            $carparks = $em->getRepository('HVGSystemBundle:Carpark')->findByUnit($unit, $sort, $direction);
        } elseif ($unitgroup) {
            $carparks = $em->getRepository('HVGSystemBundle:Carpark')->findByUnitgroup($unitgroup, $sort, $direction);
        } elseif ($community) {
            $carparks = $em->getRepository('HVGSystemBundle:Carpark')->findByCommunity($community, $sort, $direction);
        } else {
            $carparks = null;
        }

        if ($carparks) {
            $paginator = $this->get('knp_paginator');
            $carparks = $paginator->paginate($carparks, $request->query->getInt('page', 1), 100);
        }

        return $this->render('HVGAgentBundle:Carpark:index.html.twig', array(
            'communities' => $communities,
            'unitgroups' => $unitgroups,
            'units' => $units,
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'carparks' => $carparks,
            'sort' => $sort,
            'direction' => $direction,
        ));
    }

    public function showAction(Request $request, Carpark $carparks)
    {
        $unit = $carparks->getUnit();
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        return $this->render('HVGAgentBundle:Carpark:show.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'carparks' => $carparks,
        ));
    }

    public function newAction(Request $request, Unit $unit)
    {
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        $em = $this->getDoctrine()->getManager();
        $carparks = new Carpark();
        $newForm = $this->createForm(new CarparkType(), $carparks);

        return $this->render('HVGAgentBundle:Carpark:new.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'carparks' => $carparks,
            'newForm' => $newForm->createView(),
        ));
    }

    public function editAction(Request $request, Carpark $carparks)
    {
        $unit = $carparks->getUnit();
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        $editForm = $this->createForm(new CarparkType(), $carparks);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($carparks);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_carparks_index', array(
                    'community' => $community->getId(),
                    'unitgroup' => $unitgroup->getId(),
                    'unit' => $unit->getId(),
                )));
            }
        }

        return $this->render('HVGAgentBundle:Carpark:edit.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'carparks' => $carparks,
            'editForm' => $editForm->createView(),
        ));
    }

    public function deleteAction(Request $request, Carpark $carparks)
    {
        $unit = $carparks->getUnit();
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        $deleteForm = $this->createFormBuilder()->setMethod('DELETE')->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted()) {
            if($deleteForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($carparks);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_carparks_index', array(
                    'community' => $community->getId(),
                    'unitgroup' => $unitgroup->getId(),
                    'unit' => $unit->getId(),
                )));
            }
        }

        return $this->render('HVGAgentBundle:Carpark:delete.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'carparks' => $carparks,
            'deleteForm' => $deleteForm->createView(),
        ));
    }
}
