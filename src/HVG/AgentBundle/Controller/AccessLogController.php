<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\AccessLog;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Unitmemo controller.
 *
 */
class AccessLogController extends Controller
{
    public function indexAction(Request $request, Community $community = null)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();

        $sort = $request->query->has('sort') ? $request->query->get('sort') : 'createdAt';
        $direction = $request->query->has('direction') ? $request->query->get('direction') : 'DESC';

        if ($community) {
            $accesslogs = $em->getRepository('HVGSystemBundle:AccessLog')->findByCommunity($community, $sort, $direction);
        } else {
            $accesslogs = null;
        }

        if ($accesslogs) {
            $paginator = $this->get('knp_paginator');
            $accesslogs = $paginator->paginate($accesslogs, $request->query->getInt('page', 1), 100);
        }

        return $this->render('HVGAgentBundle:AccessLog:index.html.twig', array(
            'communities' => $communities,
            'community' => $community,
            'accesslogs' => $accesslogs,
            'sort' => $sort,
            'direction' => $direction,
        ));
    }

    public function showAction(Request $request, AccessLog $accesslog)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();

        $community = $accesslog->getCommunity();

        return $this->render('HVGAgentBundle:AccessLog:show.html.twig', array(
            'communities' => $communities,
            'community' => $community,
            'accesslog' => $accesslog,
        ));
    }

}
