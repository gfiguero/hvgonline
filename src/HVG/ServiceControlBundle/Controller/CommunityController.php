<?php

namespace HVG\ServiceControlBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommunityController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();
        return $this->render('HVGServiceControlBundle:Community:index.html.twig', array(
            'communities' => $communities,
        ));
    }
}
