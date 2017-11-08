<?php

namespace HVG\PublicBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\AccessPermission;
use HVG\PublicBundle\Form\AccessPermissionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AccessPermissionController extends Controller
{
    public function newAction(Request $request, $hash)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);

        $accesspermission = new AccessPermission();
        $newForm = $this->createForm(new AccessPermissionType(), $accesspermission, array('community' => $community));
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($accesspermission);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'accesspermission.new.flash' );
            }
        }

        return $this->render('HVGPublicBundle:AccessPermission:new.html.twig', array(
            'newForm' => $newForm->createView(),
            'community' => $community,
        ));
    }
}
