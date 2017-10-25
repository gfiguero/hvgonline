<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\Warehouse;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Warehouse controller.
 *
 */
class WarehouseController extends Controller
{
    public function indexAction(Request $request, Community $community = null, UnitGroup $unitgroup = null, Unit $unit = null)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();
        $unitgroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findByCommunity($community);
        $units = $em->getRepository('HVGSystemBundle:Unit')->findByUnitgroup($unitgroup);

        if($unit){
            $warehouses = $em->getRepository('HVGSystemBundle:Warehouse')->findByUnit($unit);
        } elseif ($unitgroup) {
            $warehouses = $em->getRepository('HVGSystemBundle:Warehouse')->findByUnitgroup($unitgroup);
        } elseif ($community) {
            $warehouses = $em->getRepository('HVGSystemBundle:Warehouse')->findByCommunity($community);
        } else {
            $warehouses = null;
        }


        return $this->render('HVGAgentBundle:Warehouse:index.html.twig', array(
            'communities' => $communities,
            'unitgroups' => $unitgroups,
            'units' => $units,
            'community' => $community,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'warehouses' => $warehouses,
        ));
    }
}
