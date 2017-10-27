<?php

namespace HVG\AccessControlBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\Checkpoint;
use HVG\SystemBundle\Entity\AccessGuard;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CheckpointController extends Controller
{
    public function indexAction(Request $request, $hash)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);
        $checkpoints = $em->getRepository('HVGSystemBundle:Checkpoint')->findByCommunity($community);
        return $this->render('HVGAccessControlBundle:Checkpoint:index.html.twig', array(
        	'community' => $community,
            'checkpoints' => $checkpoints,
        ));
    }

    public function changeAction(Request $request, $hash, Checkpoint $checkpoint, AccessGuard $accessguard)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);
        $checkpoints = $em->getRepository('HVGSystemBundle:Checkpoint')->findByCommunity($community);
        return $this->render('HVGAccessControlBundle:Checkpoint:change.html.twig', array(
            'community' => $community,
            'accessguard' => $accessguard,
            'checkpoint' => $checkpoint,
            'checkpoints' => $checkpoints,
        ));
    }
}
