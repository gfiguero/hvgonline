<?php

namespace HVG\AccessControlBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\AccessGate;
use HVG\SystemBundle\Entity\AccessGuard;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AccessGateController extends Controller
{
    public function indexAction(Request $request, $hash)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);
        $accessgates = $em->getRepository('HVGSystemBundle:AccessGate')->findByCommunity($community);
        return $this->render('HVGAccessControlBundle:AccessGate:index.html.twig', array(
        	'community' => $community,
            'accessgates' => $accessgates,
        ));
    }

    public function changeAction(Request $request, $hash, AccessGate $accessgate, AccessGuard $accessguard)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);
        $accessgates = $em->getRepository('HVGSystemBundle:AccessGate')->findByCommunity($community);
        return $this->render('HVGAccessControlBundle:AccessGate:change.html.twig', array(
            'community' => $community,
            'accessguard' => $accessguard,
            'accessgate' => $accessgate,
            'accessgates' => $accessgates,
        ));
    }
}
