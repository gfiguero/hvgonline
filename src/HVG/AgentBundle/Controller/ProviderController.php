<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Provider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProviderController extends Controller
{
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $providers = $em->getRepository('HVGSystemBundle:Provider')->findBy(array(), array($sort => $direction));
        else $providers = $em->getRepository('HVGSystemBundle:Provider')->findAll();
        $paginator = $this->get('knp_paginator');
        $providers = $paginator->paginate($providers, $request->query->getInt('page', 1), 100);

        return $this->render('HVGAgentBundle:Provider:index.html.twig', array(
            'providers' => $providers,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function showAction(Provider $provider)
    {
        return $this->render('HVGAgentBundle:Provider:show.html.twig', array(
            'provider' => $provider,
        ));
    }

}
