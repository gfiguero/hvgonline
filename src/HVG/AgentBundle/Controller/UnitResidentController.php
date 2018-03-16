<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\UnitResident;

use HVG\AgentBundle\Form\UnitResidentType;
use HVG\AgentBundle\Form\SearchType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Unitmemo controller.
 *
 */
class UnitResidentController extends Controller
{
    public function indexAction(Request $request, Community $community = null, UnitGroup $unitgroup = null, Unit $unit = null)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();
        $unitgroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findByCommunity($community);
        $units = $em->getRepository('HVGSystemBundle:Unit')->findByUnitgroup($unitgroup);

        $sort = $request->query->has('sort') ? $request->query->get('sort') : 'name';
        $direction = $request->query->has('direction') ? $request->query->get('direction') : 'ASC';

        if($unit){
            $unitresidents = $em->getRepository('HVGSystemBundle:UnitResident')->findByUnit($unit, $sort, $direction);
        } elseif ($unitgroup) {
            $unitresidents = $em->getRepository('HVGSystemBundle:UnitResident')->findByUnitgroup($unitgroup, $sort, $direction);
        } elseif ($community) {
            $unitresidents = $em->getRepository('HVGSystemBundle:UnitResident')->findByCommunity($community, $sort, $direction);
        } else {
            $unitresidents = null;
        }

        if ($unitresidents) {
            $paginator = $this->get('knp_paginator');
            $unitresidents = $paginator->paginate($unitresidents, $request->query->getInt('page', 1), 100);
        }

        return $this->render('HVGAgentBundle:UnitResident:index.html.twig', array(
            'communities' => $communities,
            'unitgroups' => $unitgroups,
            'units' => $units,
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'unitresidents' => $unitresidents,
            'sort' => $sort,
            'direction' => $direction,
        ));
    }

    public function showAction(Request $request, UnitResident $unitresident)
    {
        $unit = $unitresident->getUnit();
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        return $this->render('HVGAgentBundle:UnitResident:show.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'unitresident' => $unitresident,
        ));
    }

    public function newAction(Request $request, Unit $unit)
    {
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        $unitresident = new UnitResident();
        $newForm = $this->createForm(new UnitResidentType(), $unitresident);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $unitresident->setUnit($unit);
                $em = $this->getDoctrine()->getManager();
                $em->persist($unitresident);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_unitresident_index', array(
                    'community' => $community->getId(),
                    'unitgroup' => $unitgroup->getId(),
                    'unit' => $unit->getId(),
                )));
            }
        }

        return $this->render('HVGAgentBundle:UnitResident:new.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'unitresident' => $unitresident,
            'newForm' => $newForm->createView(),
        ));
    }

    public function editAction(Request $request, UnitResident $unitresident)
    {
        $unit = $unitresident->getUnit();
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        $editForm = $this->createForm(new UnitResidentType(), $unitresident);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($unitresident);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_unitresident_index', array(
                    'community' => $community->getId(),
                    'unitgroup' => $unitgroup->getId(),
                    'unit' => $unit->getId(),
                )));
            }
        }

        return $this->render('HVGAgentBundle:UnitResident:edit.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'unitresident' => $unitresident,
            'editForm' => $editForm->createView(),
        ));
    }

    public function deleteAction(Request $request, UnitResident $unitresident)
    {
        $unit = $unitresident->getUnit();
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        $deleteForm = $this->createFormBuilder()->setMethod('DELETE')->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted()) {
            if($deleteForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($unitresident);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_unitresident_index', array(
                    'community' => $community->getId(),
                    'unitgroup' => $unitgroup->getId(),
                    'unit' => $unit->getId(),
                )));
            }
        }

        return $this->render('HVGAgentBundle:UnitResident:delete.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'unitresident' => $unitresident,
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    private function createSearchForm(Community $community)
    {
        return $this->createForm(new SearchType(), null, array(
            'action' => $this->generateUrl('agent_unitresident_search', array('community' => $community->getId())),
        ));
    }

    public function searchAction(Request $request, Community $community = null)
    {
        $em = $this->getDoctrine()->getManager();
        $unitgroup = null;
        $unit = null;
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();
        $unitgroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findByCommunity($community);
        $units = $em->getRepository('HVGSystemBundle:Unit')->findByUnitgroup($unitgroup);

        $searchForm = $this->createForm(new SearchType());
        $searchForm->handleRequest($request);

        $unitresidents = null;
        if ($searchForm->isSubmitted()) {
            if($searchForm->isValid()) {
                $search = $searchForm['search']->getData();
                $unitresidents = $em->getRepository('HVGSystemBundle:UnitResident')->findBySearch($community, $search);
                dump($unitresidents);
            }
        }

        return $this->render('HVGAgentBundle:UnitResident:search.html.twig', array(
            'communities' => $communities,
            'unitgroups' => $unitgroups,
            'units' => $units,
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'unitresidents' => $unitresidents,
            'searchForm' => $searchForm->createView(),
        ));
    }
}
