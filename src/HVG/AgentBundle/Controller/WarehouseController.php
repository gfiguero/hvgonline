<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\Warehouse;

use HVG\AgentBundle\Form\WarehouseType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Unitmemo controller.
 *
 */
class WarehouseController extends Controller
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
            $warehouses = $em->getRepository('HVGSystemBundle:Warehouse')->findByUnit($unit, $sort, $direction);
        } elseif ($unitgroup) {
            $warehouses = $em->getRepository('HVGSystemBundle:Warehouse')->findByUnitgroup($unitgroup, $sort, $direction);
        } elseif ($community) {
            $warehouses = $em->getRepository('HVGSystemBundle:Warehouse')->findByCommunity($community, $sort, $direction);
        } else {
            $warehouses = null;
        }

        if ($warehouses) {
            $paginator = $this->get('knp_paginator');
            $warehouses = $paginator->paginate($warehouses, $request->query->getInt('page', 1), 100);
        }

        return $this->render('HVGAgentBundle:Warehouse:index.html.twig', array(
            'communities' => $communities,
            'unitgroups' => $unitgroups,
            'units' => $units,
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'warehouses' => $warehouses,
            'sort' => $sort,
            'direction' => $direction,
        ));
    }

    public function showAction(Request $request, Warehouse $warehouse)
    {
        $unit = $warehouse->getUnit();
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        return $this->render('HVGAgentBundle:Warehouse:show.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'warehouse' => $warehouse,
        ));
    }

    public function newAction(Request $request, Unit $unit)
    {
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        $em = $this->getDoctrine()->getManager();
        $warehouse = new Warehouse();
        $newForm = $this->createForm(new WarehouseType(), $warehouse);

        return $this->render('HVGAgentBundle:Warehouse:new.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'warehouse' => $warehouse,
            'newForm' => $newForm->createView(),
        ));
    }

    public function editAction(Request $request, Warehouse $warehouse)
    {
        $unit = $warehouse->getUnit();
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        $editForm = $this->createForm(new WarehouseType(), $warehouse);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($warehouse);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_warehouse_index', array(
                    'community' => $community->getId(),
                    'unitgroup' => $unitgroup->getId(),
                    'unit' => $unit->getId(),
                )));
            }
        }

        return $this->render('HVGAgentBundle:Warehouse:edit.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'warehouse' => $warehouse,
            'editForm' => $editForm->createView(),
        ));
    }

    public function deleteAction(Request $request, Warehouse $warehouse)
    {
        $unit = $warehouse->getUnit();
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        $deleteForm = $this->createFormBuilder()->setMethod('DELETE')->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted()) {
            if($deleteForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($warehouse);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_warehouse_index', array(
                    'community' => $community->getId(),
                    'unitgroup' => $unitgroup->getId(),
                    'unit' => $unit->getId(),
                )));
            }
        }

        return $this->render('HVGAgentBundle:Warehouse:delete.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'warehouse' => $warehouse,
            'deleteForm' => $deleteForm->createView(),
        ));
    }
}
