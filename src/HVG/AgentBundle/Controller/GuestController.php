<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\Guest;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Guest controller.
 *
 */
class GuestController extends Controller
{
    public function unitAction(Request $request, Community $community = null, UnitGroup $unitgroup = null, Unit $unit = null)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();
        $unitgroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findByCommunity($community);
        $units = $em->getRepository('HVGSystemBundle:Unit')->findByUnitgroup($unitgroup);

        if($unit){
            $guests = $em->getRepository('HVGSystemBundle:Guest')->findByUnit($unit);
        } elseif ($unitgroup) {
            $guests = $em->getRepository('HVGSystemBundle:Guest')->findByUnitgroup($unitgroup);
        } elseif ($community) {
            $guests = $em->getRepository('HVGSystemBundle:Guest')->findByCommunity($community);
        } else {
            $guests = null;
        }


        return $this->render('HVGAgentBundle:Guest:index.html.twig', array(
            'communities' => $communities,
            'unitgroups' => $unitgroups,
            'units' => $units,
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'guests' => $guests,
        ));
    }
}
