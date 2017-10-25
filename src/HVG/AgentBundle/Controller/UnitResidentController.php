<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\UnitResident;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Unitmemo controller.
 *
 */
class UnitResidentController extends Controller
{
    public function unitAction(Request $request, Community $community = null, UnitGroup $unitgroup = null, Unit $unit = null)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();
        $unitgroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findByCommunity($community);
        $units = $em->getRepository('HVGSystemBundle:Unit')->findByUnitgroup($unitgroup);

        if($unit){
            $unitresidents = $em->getRepository('HVGSystemBundle:UnitResident')->findByUnit($unit);
        } elseif ($unitgroup) {
            $unitresidents = $em->getRepository('HVGSystemBundle:UnitResident')->findByUnitgroup($unitgroup);
        } elseif ($community) {
            $unitresidents = $em->getRepository('HVGSystemBundle:UnitResident')->findByCommunity($community);
        } else {
            $unitresidents = null;
        }


        return $this->render('HVGAgentBundle:UnitResident:index.html.twig', array(
            'communities' => $communities,
            'unitgroups' => $unitgroups,
            'units' => $units,
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'unitresidents' => $unitresidents,
        ));
    }
}
