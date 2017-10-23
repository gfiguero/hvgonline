<?php

namespace HVG\AccessControlBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\AccessGate;
use HVG\SystemBundle\Entity\AccessGuard;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AccessMonitorController extends Controller
{
    public function indexAction(Request $request, $hash, AccessGate $accessgate, AccessGuard $accessguard, UnitGroup $unitgroup = null, Unit $unit = null)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);
        $unitgroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findByCommunity($community);
        $units = $em->getRepository('HVGSystemBundle:Unit')->findByUnitgroup($unitgroup);
        $unitresidents = $em->getRepository('HVGSystemBundle:UnitResident')->findByUnit($unit);
        $unitmemos = $em->getRepository('HVGSystemBundle:UnitMemo')->findByUnit($unit);
        $guests = $em->getRepository('HVGSystemBundle:Guest')->getLastByUnit($unit);
        return $this->render('HVGAccessControlBundle:AccessMonitor:index.html.twig', array(
            'community' => $community,
            'accessgate' => $accessgate,
            'accessguard' => $accessguard,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
            'unitgroups' => $unitgroups,
            'units' => $units,
            'unitresidents' => $unitresidents,
            'unitmemos' => $unitmemos,
            'guests' => $guests,
        ));

    }
}
