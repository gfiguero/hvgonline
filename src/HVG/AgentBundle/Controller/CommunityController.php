<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommunityController extends Controller
{
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $communities = $em->getRepository('HVGSystemBundle:Community')->findBy(array(), array($sort => $direction));
        else $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();
        $paginator = $this->get('knp_paginator');
        $communities = $paginator->paginate($communities, $request->query->getInt('page', 1), 100);

        return $this->render('HVGAgentBundle:Community:index.html.twig', array(
            'communities' => $communities,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function showAction(Community $community)
    {
        $buildings = $community->getBuildings();
        $communityStaffs = $community->getCommunityStaffs();

        return $this->render('HVGAgentBundle:Community:show.html.twig', array(
            'community' => $community,
            'buildings' => $buildings,
            'communityStaffs' => $communityStaffs,
        ));
    }

}
