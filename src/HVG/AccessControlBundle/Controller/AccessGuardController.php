<?php

namespace HVG\AccessControlBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\AccessGate;
use HVG\SystemBundle\Entity\AccessGuard;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AccessGuardController extends Controller
{
    public function indexAction(Request $request, $hash, AccessGate $accessgate)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);
        $accessguards = $em->getRepository('HVGSystemBundle:AccessGuard')->findByCommunity($community);
        return $this->render('HVGAccessControlBundle:AccessGuard:index.html.twig', array(
            'community' => $community,
            'accessgate' => $accessgate,
            'accessguards' => $accessguards,
        ));
    }

    public function changeAction(Request $request, $hash, AccessGate $accessgate, AccessGuard $accessguard)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);
        $accessguards = $em->getRepository('HVGSystemBundle:AccessGuard')->findByCommunity($community);
        return $this->render('HVGAccessControlBundle:AccessGuard:change.html.twig', array(
            'community' => $community,
            'accessgate' => $accessgate,
            'accessguard' => $accessguard,
            'accessguards' => $accessguards,
        ));
    }
}
