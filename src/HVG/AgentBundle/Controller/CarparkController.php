<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\Carpark;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Carpark controller.
 *
 */
class CarparkController extends Controller
{
    public function unitAction(Request $request, Community $community = null, UnitGroup $unitgroup = null, Unit $unit = null)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();
        $unitgroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findByCommunity($community);
        $units = $em->getRepository('HVGSystemBundle:Unit')->findByUnitgroup($unitgroup);

        if($unit){
            $carparks = $em->getRepository('HVGSystemBundle:Carpark')->findByUnit($unit);
        } elseif ($unitgroup) {
            $carparks = $em->getRepository('HVGSystemBundle:Carpark')->findByUnitgroup($unitgroup);
        } elseif ($community) {
            $carparks = $em->getRepository('HVGSystemBundle:Carpark')->findByCommunity($community);
        } else {
            $carparks = null;
        }


        return $this->render('HVGAgentBundle:Carpark:index.html.twig', array(
            'communities' => $communities,
            'unitgroups' => $unitgroups,
            'units' => $units,
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'carparks' => $carparks,
        ));
    }
}
