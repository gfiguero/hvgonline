<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\CommunityStaff;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommunityStaffController extends Controller
{
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $communityStaffs = $em->getRepository('HVGSystemBundle:CommunityStaff')->findBy(array(), array($sort => $direction));
        else $communityStaffs = $em->getRepository('HVGSystemBundle:CommunityStaff')->findAll();
        $paginator = $this->get('knp_paginator');
        $communityStaffs = $paginator->paginate($communityStaffs, $request->query->getInt('page', 1), 100);

        return $this->render('HVGAgentBundle:CommunityStaff:index.html.twig', array(
            'communityStaffs' => $communityStaffs,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function showAction(CommunityStaff $communityStaff)
    {
        $community = $communityStaff->getCommunity();
        $person = $communityStaff->getPerson();
        $role = $communityStaff->getRole();

        return $this->render('HVGAgentBundle:CommunityStaff:show.html.twig', array(
            'role' => $role,
            'person' => $person,
            'community' => $community,
            'communityStaff' => $communityStaff,
        ));
    }

}
