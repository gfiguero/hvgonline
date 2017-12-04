<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\CommunityEvent;

use HVG\AgentBundle\Form\CommunityEventType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Unitmemo controller.
 *
 */
class CommunityEventController extends Controller
{
    public function indexAction(Request $request, Community $community = null)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();

        $sort = $request->query->has('sort') ? $request->query->get('sort') : 'id';
        $direction = $request->query->has('direction') ? $request->query->get('direction') : 'ASC';

        if ($community) {
            $communityevents = $em->getRepository('HVGSystemBundle:CommunityEvent')->findByCommunity($community, $sort, $direction);
        } else {
            $communityevents = null;
        }

        if ($communityevents) {
            $paginator = $this->get('knp_paginator');
            $communityevents = $paginator->paginate($communityevents, $request->query->getInt('page', 1), 100);
        }

        return $this->render('HVGAgentBundle:CommunityEvent:index.html.twig', array(
            'communities' => $communities,
            'community' => $community,
            'communityevents' => $communityevents,
            'sort' => $sort,
            'direction' => $direction,
        ));
    }

    public function showAction(Request $request, CommunityEvent $communityevent)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();

        $community = $communityevent->getCommunity();

        return $this->render('HVGAgentBundle:CommunityEvent:show.html.twig', array(
            'communities' => $communities,
            'community' => $community,
            'communityevent' => $communityevent,
        ));
    }

    public function newAction(Request $request, Community $community)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();

        $communityevent = new CommunityEvent();
        $communityevent->setStartedAt(new \Datetime());
        $communityevent->setFinnishedAt(new \Datetime('+1 day'));
        $newForm = $this->createForm(new CommunityEventType(), $communityevent, array('community' => $community));
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $communityevent->setCommunity($community);
                $em = $this->getDoctrine()->getManager();
                $em->persist($communityevent);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_communityevent_index', array(
                    'community' => $community->getId(),
                )));
            }
        }

        return $this->render('HVGAgentBundle:CommunityEvent:new.html.twig', array(
            'communities' => $communities,
            'community' => $community,
            'communityevent' => $communityevent,
            'newForm' => $newForm->createView(),
        ));
    }

    public function editAction(Request $request, CommunityEvent $communityevent)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();

        $community = $communityevent->getCommunity();
        $editForm = $this->createForm(new CommunityEventType(), $communityevent, array('community' => $community));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($communityevent);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_communityevent_index', array(
                    'community' => $community->getId(),
                )));
            }
        }

        return $this->render('HVGAgentBundle:CommunityEvent:edit.html.twig', array(
            'communities' => $communities,
            'community' => $community,
            'communityevent' => $communityevent,
            'editForm' => $editForm->createView(),
        ));
    }

    public function deleteAction(Request $request, CommunityEvent $communityevent)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();

        $community = $communityevent->getCommunity();
        $deleteForm = $this->createFormBuilder()->setMethod('DELETE')->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted()) {
            if($deleteForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($communityevent);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_communityevent_index', array(
                    'community' => $community->getId(),
                )));
            }
        }

        return $this->render('HVGAgentBundle:CommunityEvent:delete.html.twig', array(
            'communities' => $communities,
            'community' => $community,
            'communityevent' => $communityevent,
            'deleteForm' => $deleteForm->createView(),
        ));
    }
}
