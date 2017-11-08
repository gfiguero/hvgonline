<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\GuestCarpark;

use HVG\AgentBundle\Form\GuestCarparkType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Unitmemo controller.
 *
 */
class GuestCarparkController extends Controller
{
    public function indexAction(Request $request, Community $community = null)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();

        $sort = $request->query->has('sort') ? $request->query->get('sort') : 'id';
        $direction = $request->query->has('direction') ? $request->query->get('direction') : 'ASC';

        if ($community) {
            $guestcarparks = $em->getRepository('HVGSystemBundle:GuestCarpark')->findByCommunity($community, $sort, $direction);
        } else {
            $guestcarparks = null;
        }

        if ($guestcarparks) {
            $paginator = $this->get('knp_paginator');
            $guestcarparks = $paginator->paginate($guestcarparks, $request->query->getInt('page', 1), 100);
        }

        return $this->render('HVGAgentBundle:GuestCarpark:index.html.twig', array(
            'communities' => $communities,
            'community' => $community,
            'guestcarparks' => $guestcarparks,
            'sort' => $sort,
            'direction' => $direction,
        ));
    }

    public function showAction(Request $request, GuestCarpark $guestcarpark)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();

        $community = $guestcarpark->getCommunity();

        return $this->render('HVGAgentBundle:GuestCarpark:show.html.twig', array(
            'communities' => $communities,
            'community' => $community,
            'guestcarpark' => $guestcarpark,
        ));
    }

    public function newAction(Request $request, Community $community)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();

        $guestcarpark = new GuestCarpark();
        $newForm = $this->createForm(new GuestCarparkType(), $guestcarpark);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $guestcarpark->setCommunity($community);
                $em = $this->getDoctrine()->getManager();
                $em->persist($guestcarpark);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_guestcarpark_index', array(
                    'community' => $community->getId(),
                )));
            }
        }

        return $this->render('HVGAgentBundle:GuestCarpark:new.html.twig', array(
            'communities' => $communities,
            'community' => $community,
            'guestcarpark' => $guestcarpark,
            'newForm' => $newForm->createView(),
        ));
    }

    public function editAction(Request $request, GuestCarpark $guestcarpark)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();

        $community = $guestcarpark->getCommunity();
        $editForm = $this->createForm(new GuestCarparkType(), $guestcarpark);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($guestcarpark);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_guestcarpark_index', array(
                    'community' => $community->getId(),
                )));
            }
        }

        return $this->render('HVGAgentBundle:GuestCarpark:edit.html.twig', array(
            'communities' => $communities,
            'community' => $community,
            'guestcarpark' => $guestcarpark,
            'editForm' => $editForm->createView(),
        ));
    }

    public function deleteAction(Request $request, GuestCarpark $guestcarpark)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();

        $community = $guestcarpark->getCommunity();
        $deleteForm = $this->createFormBuilder()->setMethod('DELETE')->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted()) {
            if($deleteForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($guestcarpark);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_guestcarpark_index', array(
                    'community' => $community->getId(),
                )));
            }
        }

        return $this->render('HVGAgentBundle:GuestCarpark:delete.html.twig', array(
            'communities' => $communities,
            'community' => $community,
            'guestcarpark' => $guestcarpark,
            'deleteForm' => $deleteForm->createView(),
        ));
    }
}
