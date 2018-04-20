<?php

namespace HVG\ServiceControlBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\Service;
use HVG\SystemBundle\Entity\ServiceAgent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ServiceController extends Controller
{
    public function indexAction(Request $request, $hash)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);
        $services = $em->getRepository('HVGSystemBundle:Service')->findByCommunity($community);
        return $this->render('HVGServiceControlBundle:Service:index.html.twig', array(
        	'community' => $community,
            'services' => $services,
        ));
    }

    public function changeAction(Request $request, $hash, Service $service, ServiceAgent $serviceagent)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);
        $services = $em->getRepository('HVGSystemBundle:Service')->findByCommunity($community);
        return $this->render('HVGServiceControlBundle:Service:change.html.twig', array(
            'community' => $community,
            'serviceagent' => $serviceagent,
            'service' => $service,
            'services' => $services,
        ));
    }
}
