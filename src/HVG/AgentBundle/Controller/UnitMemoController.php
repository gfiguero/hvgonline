<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\UnitMemo;

use HVG\AgentBundle\Form\UnitMemoType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Unitmemo controller.
 *
 */
class UnitMemoController extends Controller
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
            $unitmemos = $em->getRepository('HVGSystemBundle:UnitMemo')->findByUnit($unit, $sort, $direction);
        } elseif ($unitgroup) {
            $unitmemos = $em->getRepository('HVGSystemBundle:UnitMemo')->findByUnitgroup($unitgroup, $sort, $direction);
        } elseif ($community) {
            $unitmemos = $em->getRepository('HVGSystemBundle:UnitMemo')->findByCommunity($community, $sort, $direction);
        } else {
            $unitmemos = null;
        }

        if ($unitmemos) {
            $paginator = $this->get('knp_paginator');
            $unitmemos = $paginator->paginate($unitmemos, $request->query->getInt('page', 1), 100);
        }

        return $this->render('HVGAgentBundle:UnitMemo:index.html.twig', array(
            'communities' => $communities,
            'unitgroups' => $unitgroups,
            'units' => $units,
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'unitmemos' => $unitmemos,
            'sort' => $sort,
            'direction' => $direction,
        ));
    }

    public function showAction(Request $request, UnitMemo $unitmemo)
    {
        $unit = $unitmemo->getUnit();
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        return $this->render('HVGAgentBundle:UnitMemo:show.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'unitmemo' => $unitmemo,
        ));
    }

    public function newAction(Request $request, Unit $unit)
    {
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        $em = $this->getDoctrine()->getManager();
        $unitmemo = new UnitMemo();
        $newForm = $this->createForm(new UnitMemoType(), $unitmemo);

        return $this->render('HVGAgentBundle:UnitMemo:new.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'unitmemo' => $unitmemo,
            'newForm' => $newForm->createView(),
        ));
    }

    public function editAction(Request $request, UnitMemo $unitmemo)
    {
        $unit = $unitmemo->getUnit();
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        $editForm = $this->createForm(new UnitMemoType(), $unitmemo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($unitmemo);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_unitmemo_index', array(
                    'community' => $community->getId(),
                    'unitgroup' => $unitgroup->getId(),
                    'unit' => $unit->getId(),
                )));
            }
        }

        return $this->render('HVGAgentBundle:UnitMemo:edit.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'unitmemo' => $unitmemo,
            'editForm' => $editForm->createView(),
        ));
    }

    public function deleteAction(Request $request, UnitMemo $unitmemo)
    {
        $unit = $unitmemo->getUnit();
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        $deleteForm = $this->createFormBuilder()->setMethod('DELETE')->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted()) {
            if($deleteForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($unitmemo);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_unitmemo_index', array(
                    'community' => $community->getId(),
                    'unitgroup' => $unitgroup->getId(),
                    'unit' => $unit->getId(),
                )));
            }
        }

        return $this->render('HVGAgentBundle:UnitMemo:delete.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'unitmemo' => $unitmemo,
            'deleteForm' => $deleteForm->createView(),
        ));
    }
}
