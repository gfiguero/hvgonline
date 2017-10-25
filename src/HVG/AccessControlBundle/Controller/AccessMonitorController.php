<?php

namespace HVG\AccessControlBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\AccessGate;
use HVG\SystemBundle\Entity\AccessGuard;
use HVG\AccessControlBundle\Form\MonitorType;
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
        if ($unit) {
            $guests = $em->getRepository('HVGSystemBundle:Guest')->getLastByUnit($unit);
        } elseif ($unitgroup) {
            $guests = $em->getRepository('HVGSystemBundle:Guest')->getLastByUnitgroup($unitgroup);
        } else {
            $guests = $em->getRepository('HVGSystemBundle:Guest')->getLastByCommunity($community);
        }

        $searchForm = $this->createForm(new MonitorType());

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
            'searchForm' => $searchForm->createView(),
        ));
    }

    public function searchAction(Request $request, $hash, AccessGate $accessgate, AccessGuard $accessguard)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);

        $searchForm = $this->createForm(new MonitorType());
        $searchForm->handleRequest($request);

        if ($searchForm->isSubmitted()) {
            if($searchForm->isValid()) {
                $search = $searchForm['monitor']->getData();
                $unitresidents = $em->getRepository('HVGSystemBundle:UnitResident')->findBySearch($community, $search);
                $unitmemos = $em->getRepository('HVGSystemBundle:UnitMemo')->findBySearch($community, $search);
                $guests = $em->getRepository('HVGSystemBundle:Guest')->findBySearch($community, $search);

                return $this->render('HVGAccessControlBundle:AccessMonitor:search.html.twig', array(
                    'community' => $community,
                    'accessgate' => $accessgate,
                    'accessguard' => $accessguard,
                    'unitresidents' => $unitresidents,
                    'unitmemos' => $unitmemos,
                    'guests' => $guests,
                    'searchForm' => $searchForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('accesscontrol_accessmonitor_index', array('hash' => $hash, 'accessgate' => $accessgate->getId(), 'accessguard' => $accessguard->getId())));

    }
}
