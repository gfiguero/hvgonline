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
    public function indexAction(Request $request, Community $community = null)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();

        $sort = $request->query->has('sort') ? $request->query->get('sort') : 'id';
        $direction = $request->query->has('direction') ? $request->query->get('direction') : 'ASC';

        if ($community) {
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
            'community' => $community,
            'carparks' => $carparks,
            'sort' => $sort,
            'direction' => $direction,
        ));
    }

    public function showAction(Request $request, Carpark $carpark)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();

        $community = $carpark->getCommunity();

        return $this->render('HVGAgentBundle:Carpark:show.html.twig', array(
            'communities' => $communities,
            'community' => $community,
            'carpark' => $carpark,
        ));
    }

    public function newAction(Request $request, Community $community)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();

        $carpark = new Carpark();
        $newForm = $this->createForm(new CarparkType(), $carpark, array('community' => $community));
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $carpark->setCommunity($community);
                $em = $this->getDoctrine()->getManager();
                $em->persist($carpark);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_carpark_index', array(
                    'community' => $community->getId(),
                )));
            }
        }

        return $this->render('HVGAgentBundle:Carpark:new.html.twig', array(
            'communities' => $communities,
            'community' => $community,
            'carpark' => $carpark,
            'newForm' => $newForm->createView(),
        ));
    }

    public function editAction(Request $request, Carpark $carpark)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();

        $community = $carpark->getCommunity();
        $editForm = $this->createForm(new CarparkType(), $carpark, array('community' => $community));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($carpark);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_carpark_index', array(
                    'community' => $community->getId(),
                )));
            }
        }

        return $this->render('HVGAgentBundle:Carpark:edit.html.twig', array(
            'communities' => $communities,
            'community' => $community,
            'carpark' => $carpark,
            'editForm' => $editForm->createView(),
        ));
    }

    public function deleteAction(Request $request, Carpark $carpark)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();

        $community = $carpark->getCommunity();
        $deleteForm = $this->createFormBuilder()->setMethod('DELETE')->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted()) {
            if($deleteForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($carpark);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_carpark_index', array(
                    'community' => $community->getId(),
                )));
            }
        }

        return $this->render('HVGAgentBundle:Carpark:delete.html.twig', array(
            'communities' => $communities,
            'community' => $community,
            'carpark' => $carpark,
            'deleteForm' => $deleteForm->createView(),
        ));
    }
}
