<?php

namespace HVG\ServiceControlBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\Service;
use HVG\SystemBundle\Entity\ServiceAgent;
use HVG\SystemBundle\Entity\ServiceLog;
use HVG\ServiceControlBundle\Form\ServiceLogType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ServiceLogController extends Controller
{
    public function indexAction(Request $request, $hash, Service $service, ServiceAgent $serviceagent )
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);
        $servicelogs = $em->getRepository('HVGSystemBundle:ServiceLog')->getLastByCommunity($community);

        return $this->render('HVGServiceControlBundle:ServiceLog:index.html.twig', array(
            'community' => $community,
            'service' => $service,
            'serviceagent' => $serviceagent,
            'servicelogs' => $servicelogs,
        ));
    }

    public function newAction(Request $request, $hash, Service $service, ServiceAgent $serviceagent)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);

        $servicelog = new ServiceLog();
        $newForm = $this->createForm(new ServiceLogType(), $servicelog);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $servicelog->setService($service);
                $servicelog->setServiceAgent($serviceagent);
                $em->persist($servicelog);
                $em->flush();
                return $this->redirect($this->generateUrl('servicecontrol_servicelog_index', array('hash' => $hash, 'service' => $service->getId(), 'serviceagent' => $serviceagent->getId())));
            }
        }

        return $this->render('HVGServiceControlBundle:ServiceLog:new.html.twig', array(
            'newForm' => $newForm->createView(),
            'community' => $community,
            'service' => $service,
            'serviceagent' => $serviceagent,
        ));
    }

}
