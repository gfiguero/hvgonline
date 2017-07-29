<?php

namespace HVG\PublicBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitInsurancePolicy;
use HVG\PublicBundle\Form\UnitInsurancePolicyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UnitInsurancePolicyController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();
        return $this->render('HVGPublicBundle:UnitInsurancePolicy:index.html.twig', array(
            'communities' => $communities,
        ));
    }

    public function newAction(Request $request, $hash)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);
        $unitInsurancePolicy = new UnitInsurancePolicy();
        $newForm = $this->createForm(new UnitInsurancePolicyType(), $unitInsurancePolicy, array('community' => $community));
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($unitInsurancePolicy);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'unitinsurancepolicy.new.flash' );
                return $this->render('HVGPublicBundle:UnitInsurancePolicy:finish.html.twig', array(
                    'community' => $community,
                ));
//                return $this->redirect($this->generateUrl('public_unitinsurancepolicy_new', array('community' => $community->getId())));
            }
        }

        return $this->render('HVGPublicBundle:UnitInsurancePolicy:new.html.twig', array(
            'newForm' => $newForm->createView(),
            'community' => $community,
        ));
    }
}
