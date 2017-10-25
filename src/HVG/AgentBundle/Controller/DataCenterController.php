<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\UnitResident;

use HVG\AgentBundle\Form\UnitResidentType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * DataCenter controller.
 *
 */
class DataCenterController extends Controller
{
    public function unitAction(Request $request, Unit $unit)
    {
        $em = $this->getDoctrine()->getManager();

        $community = $unit->getCommunity();
        $unitgroup = $unit->getUnitgroup();

        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();
        $unitgroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findByCommunity($community);
        $units = $em->getRepository('HVGSystemBundle:Unit')->findByUnitgroup($unitgroup);

        return $this->render('HVGAgentBundle:DataCenter:unit.html.twig', array(
            'communities' => $communities,
            'unitgroups' => $unitgroups,
            'units' => $units,
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
        ));
    }

    public function unitgroupAction(Request $request, UnitGroup $unitgroup)
    {
        $em = $this->getDoctrine()->getManager();

        $community = $unitgroup->getCommunity();

        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();
        $unitgroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findByCommunity($community);
        $units = $em->getRepository('HVGSystemBundle:Unit')->findByUnitgroup($unitgroup);

        return $this->render('HVGAgentBundle:DataCenter:unitgroup.html.twig', array(
            'communities' => $communities,
            'unitgroups' => $unitgroups,
            'units' => $units,
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => null,
        ));
    }

    public function communityAction(Request $request, Community $community)
    {
        $em = $this->getDoctrine()->getManager();

        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();
        $unitgroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findByCommunity($community);

        return $this->render('HVGAgentBundle:DataCenter:unitgroup.html.twig', array(
            'communities' => $communities,
            'unitgroups' => $unitgroups,
            'units' => null,
            'community' => $community,
            'unitgroup' => null,
            'unit' => null,
        ));
    }
}
