<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\Guest;

use HVG\AgentBundle\Form\GuestType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Unitmemo controller.
 *
 */
class GuestController extends Controller
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
            $guests = $em->getRepository('HVGSystemBundle:Guest')->findByUnit($unit, $sort, $direction);
        } elseif ($unitgroup) {
            $guests = $em->getRepository('HVGSystemBundle:Guest')->findByUnitgroup($unitgroup, $sort, $direction);
        } elseif ($community) {
            $guests = $em->getRepository('HVGSystemBundle:Guest')->findByCommunity($community, $sort, $direction);
        } else {
            $guests = null;
        }

        if ($guests) {
            $paginator = $this->get('knp_paginator');
            $guests = $paginator->paginate($guests, $request->query->getInt('page', 1), 100);
        }

        return $this->render('HVGAgentBundle:Guest:index.html.twig', array(
            'communities' => $communities,
            'unitgroups' => $unitgroups,
            'units' => $units,
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'guests' => $guests,
            'sort' => $sort,
            'direction' => $direction,
        ));
    }

    public function showAction(Request $request, Guest $guest)
    {
        $unit = $guest->getUnit();
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        return $this->render('HVGAgentBundle:Guest:show.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'guest' => $guest,
        ));
    }

    public function newAction(Request $request, Unit $unit)
    {
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        $em = $this->getDoctrine()->getManager();
        $guest = new Guest();
        $newForm = $this->createForm(new GuestType(), $guest);

        return $this->render('HVGAgentBundle:Guest:new.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'guest' => $guest,
            'newForm' => $newForm->createView(),
        ));
    }

    public function editAction(Request $request, Guest $guest)
    {
        $unit = $guest->getUnit();
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        $editForm = $this->createForm(new GuestType(), $guest);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($guest);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_guest_index', array(
                    'community' => $community->getId(),
                    'unitgroup' => $unitgroup->getId(),
                    'unit' => $unit->getId(),
                )));
            }
        }

        return $this->render('HVGAgentBundle:Guest:edit.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'guest' => $guest,
            'editForm' => $editForm->createView(),
        ));
    }

    public function deleteAction(Request $request, Guest $guest)
    {
        $unit = $guest->getUnit();
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        $deleteForm = $this->createFormBuilder()->setMethod('DELETE')->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted()) {
            if($deleteForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($guest);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_guest_index', array(
                    'community' => $community->getId(),
                    'unitgroup' => $unitgroup->getId(),
                    'unit' => $unit->getId(),
                )));
            }
        }

        return $this->render('HVGAgentBundle:Guest:delete.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'guest' => $guest,
            'deleteForm' => $deleteForm->createView(),
        ));
    }
}
