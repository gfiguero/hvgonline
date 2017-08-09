<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\UnitInsurancePolicy;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UnitInsurancePolicyController extends Controller
{
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $unitinsurancepolicies = $em->getRepository('HVGSystemBundle:UnitInsurancePolicy')->findBy(array(), array($sort => $direction));
        else $unitinsurancepolicies = $em->getRepository('HVGSystemBundle:UnitInsurancePolicy')->findBy(array(), array('createdAt' => 'DESC'));
        $paginator = $this->get('knp_paginator');
        $unitinsurancepolicies = $paginator->paginate($unitinsurancepolicies, $request->query->getInt('page', 1), 100);

        return $this->render('HVGAgentBundle:UnitInsurancePolicy:index.html.twig', array(
            'unitinsurancepolicies' => $unitinsurancepolicies,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function showAction(UnitInsurancePolicy $unitinsurancepolicy)
    {
        return $this->render('HVGAgentBundle:UnitInsurancePolicy:show.html.twig', array(
            'unitinsurancepolicy' => $unitinsurancepolicy,
        ));
    }

}
