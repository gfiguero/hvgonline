<?php

namespace HVG\PublicBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
    public function indexAction(Request $request, $hash)
    {
        $host = $this->getRequest()->getHost();
        $em = $this->getDoctrine()->getManager();
//        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHost($host);
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);
        return $this->render('HVGPublicBundle:Page:index.html.twig', array(
            'community' => $community,
        ));
    }
}
