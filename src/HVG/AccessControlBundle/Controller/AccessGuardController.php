<?php

namespace HVG\AccessControlBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\Checkpoint;
use HVG\SystemBundle\Entity\AccessGuard;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AccessGuardController extends Controller
{
    public function indexAction(Request $request, $hash, Checkpoint $checkpoint)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);
        $accessguards = $em->getRepository('HVGSystemBundle:AccessGuard')->findByCommunity($community);
        return $this->render('HVGAccessControlBundle:AccessGuard:index.html.twig', array(
            'community' => $community,
            'checkpoint' => $checkpoint,
            'accessguards' => $accessguards,
        ));
    }

    public function changeAction(Request $request, $hash, Checkpoint $checkpoint, AccessGuard $accessguard)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);
        $accessguards = $em->getRepository('HVGSystemBundle:AccessGuard')->findByCommunity($community);
        return $this->render('HVGAccessControlBundle:AccessGuard:change.html.twig', array(
            'community' => $community,
            'checkpoint' => $checkpoint,
            'accessguard' => $accessguard,
            'accessguards' => $accessguards,
        ));
    }
}
