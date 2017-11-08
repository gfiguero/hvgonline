<?php

namespace HVG\PublicBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    public function indexAction(Request $request, $hash)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);
        return $this->render('HVGPublicBundle:Dashboard:index.html.twig', array(
            'community' => $community,
        ));
    }
}
