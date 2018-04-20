<?php

namespace HVG\ServiceControlBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\Service;
use HVG\SystemBundle\Entity\ServiceAgent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ServiceAgentController extends Controller
{
    public function indexAction(Request $request, $hash, Service $service)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);
        $serviceagents = $em->getRepository('HVGSystemBundle:ServiceAgent')->findByCommunity($community);
        return $this->render('HVGServiceControlBundle:ServiceAgent:index.html.twig', array(
            'community' => $community,
            'service' => $service,
            'serviceagents' => $serviceagents,
        ));
    }

    public function changeAction(Request $request, $hash, Service $service, ServiceAgent $serviceagent)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);
        $serviceagents = $em->getRepository('HVGSystemBundle:ServiceAgent')->findByCommunity($community);
        return $this->render('HVGServiceControlBundle:ServiceAgent:change.html.twig', array(
            'community' => $community,
            'service' => $service,
            'serviceagent' => $serviceagent,
            'serviceagents' => $serviceagents,
        ));
    }
}
