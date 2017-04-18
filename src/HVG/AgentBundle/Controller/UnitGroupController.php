<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\UnitGroup;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UnitGroupController extends Controller
{
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $unitgroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findBy(array(), array($sort => $direction));
        else $unitgroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findAll();
        $paginator = $this->get('knp_paginator');
        $unitgroups = $paginator->paginate($unitgroups, $request->query->getInt('page', 1), 100);

        return $this->render('HVGAgentBundle:UnitGroup:index.html.twig', array(
            'unitgroups' => $unitgroups,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function showAction(UnitGroup $unitgroup)
    {
        $em = $this->getDoctrine()->getManager();
        $units = $em->getRepository('HVGSystemBundle:Unit')->findBy(array('unitgroup' => $unitgroup->getId()), array('name' => 'ASC'));

        return $this->render('HVGAgentBundle:UnitGroup:show.html.twig', array(
            'unitgroup' => $unitgroup,
            'units' => $units,
        ));
    }

}
