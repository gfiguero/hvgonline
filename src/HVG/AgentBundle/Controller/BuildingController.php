<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Building;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BuildingController extends Controller
{
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $buildings = $em->getRepository('HVGSystemBundle:Building')->findBy(array(), array($sort => $direction));
        else $buildings = $em->getRepository('HVGSystemBundle:Building')->findAll();
        $paginator = $this->get('knp_paginator');
        $buildings = $paginator->paginate($buildings, $request->query->getInt('page', 1), 100);

        return $this->render('HVGAgentBundle:Building:index.html.twig', array(
            'buildings' => $buildings,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function showAction(Building $building)
    {
        $em = $this->getDoctrine()->getManager();
        $units = $em->getRepository('HVGSystemBundle:Unit')->findBy(array('building' => $building->getId()), array('name' => 'ASC'));

        return $this->render('HVGAgentBundle:Building:show.html.twig', array(
            'building' => $building,
            'units' => $units,
        ));
    }

}
