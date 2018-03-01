<?php

namespace HVG\AccessControlBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\Checkpoint;
use HVG\SystemBundle\Entity\AccessGuard;
use HVG\SystemBundle\Entity\AccessLog;
use HVG\AccessControlBundle\Form\AccessLogType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AccessLogController extends Controller
{
    public function indexAction(Request $request, $hash, Checkpoint $checkpoint, AccessGuard $accessguard )
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);
        $accesslogs = $em->getRepository('HVGSystemBundle:AccessLog')->getLastByCommunity($community);
        dump($accesslogs);

        return $this->render('HVGAccessControlBundle:AccessLog:index.html.twig', array(
            'community' => $community,
            'checkpoint' => $checkpoint,
            'accessguard' => $accessguard,
            'accesslogs' => $accesslogs,
        ));
    }

    public function newAction(Request $request, $hash, Checkpoint $checkpoint, AccessGuard $accessguard)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);

        $accessLog = new AccessLog();
        $newForm = $this->createForm(new AccessLogType(), $accessLog);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $accessLog->setCheckpoint($checkpoint);
                $accessLog->setAccessguard($accessguard);
                $em->persist($accessLog);
                $em->flush();
                return $this->redirect($this->generateUrl('accesscontrol_accesslog_index', array('hash' => $hash, 'checkpoint' => $checkpoint->getId(), 'accessguard' => $accessguard->getId())));
            }
        }

        return $this->render('HVGAccessControlBundle:AccessLog:new.html.twig', array(
            'newForm' => $newForm->createView(),
            'community' => $community,
            'checkpoint' => $checkpoint,
            'accessguard' => $accessguard,
        ));
    }

}
