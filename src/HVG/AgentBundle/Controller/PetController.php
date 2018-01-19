<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\Pet;

use HVG\AgentBundle\Form\PetType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Unitmemo controller.
 *
 */
class PetController extends Controller
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
            $pets = $em->getRepository('HVGSystemBundle:Pet')->findByUnit($unit, $sort, $direction);
        } elseif ($unitgroup) {
            $pets = $em->getRepository('HVGSystemBundle:Pet')->findByUnitgroup($unitgroup, $sort, $direction);
        } elseif ($community) {
            $pets = $em->getRepository('HVGSystemBundle:Pet')->findByCommunity($community, $sort, $direction);
        } else {
            $pets = null;
        }

        if ($pets) {
            $paginator = $this->get('knp_paginator');
            $pets = $paginator->paginate($pets, $request->query->getInt('page', 1), 100);
        }

        return $this->render('HVGAgentBundle:Pet:index.html.twig', array(
            'communities' => $communities,
            'unitgroups' => $unitgroups,
            'units' => $units,
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'pets' => $pets,
            'sort' => $sort,
            'direction' => $direction,
        ));
    }

    public function showAction(Request $request, Pet $pet)
    {
        $unit = $pet->getUnit();
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        return $this->render('HVGAgentBundle:Pet:show.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'pet' => $pet,
        ));
    }

    public function newAction(Request $request, Unit $unit)
    {
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        $pet = new Pet();
        $newForm = $this->createForm(new PetType(), $pet);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $pet->setUnit($unit);
                $em = $this->getDoctrine()->getManager();
                $em->persist($pet);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_pet_index', array(
                    'community' => $community->getId(),
                    'unitgroup' => $unitgroup->getId(),
                    'unit' => $unit->getId(),
                )));
            }
        }

        return $this->render('HVGAgentBundle:Pet:new.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'pet' => $pet,
            'newForm' => $newForm->createView(),
        ));
    }

    public function editAction(Request $request, Pet $pet)
    {
        $unit = $pet->getUnit();
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        $editForm = $this->createForm(new PetType(), $pet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($pet);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_pet_index', array(
                    'community' => $community->getId(),
                    'unitgroup' => $unitgroup->getId(),
                    'unit' => $unit->getId(),
                )));
            }
        }

        return $this->render('HVGAgentBundle:Pet:edit.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'pet' => $pet,
            'editForm' => $editForm->createView(),
        ));
    }

    public function deleteAction(Request $request, Pet $pet)
    {
        $unit = $pet->getUnit();
        $unitgroup = $unit->getUnitgroup();
        $community = $unitgroup->getCommunity();

        $deleteForm = $this->createFormBuilder()->setMethod('DELETE')->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted()) {
            if($deleteForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($pet);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_pet_index', array(
                    'community' => $community->getId(),
                    'unitgroup' => $unitgroup->getId(),
                    'unit' => $unit->getId(),
                )));
            }
        }

        return $this->render('HVGAgentBundle:Pet:delete.html.twig', array(
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'pet' => $pet,
            'deleteForm' => $deleteForm->createView(),
        ));
    }
}
