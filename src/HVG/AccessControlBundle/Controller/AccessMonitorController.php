<?php

namespace HVG\AccessControlBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\Checkpoint;
use HVG\SystemBundle\Entity\AccessGuard;
use HVG\AccessControlBundle\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AccessMonitorController extends Controller
{
    public function indexAction(Request $request, $hash, Checkpoint $checkpoint, AccessGuard $accessguard, UnitGroup $unitgroup = null, Unit $unit = null)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);
        $unitgroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findByCommunity($community);
        $communityevents = $em->getRepository('HVGSystemBundle:CommunityEvent')->findValidByCommunity($community);
        $units = $em->getRepository('HVGSystemBundle:Unit')->findByUnitgroup($unitgroup);
        $unitresidents = $em->getRepository('HVGSystemBundle:UnitResident')->findByUnit($unit, 'name', 'ASC');
        $unitmemos = $em->getRepository('HVGSystemBundle:UnitMemo')->getAvailableByUnit($unit);
        if ($unit) {
            $guests = $em->getRepository('HVGSystemBundle:Guest')->getLastByUnit($unit);
        } elseif ($unitgroup) {
            $guests = $em->getRepository('HVGSystemBundle:Guest')->getLastByUnitgroup($unitgroup);
        } else {
            $guests = $em->getRepository('HVGSystemBundle:Guest')->getLastByCommunity($community);
        }

        $searchForm = $this->createForm(new SearchType());

        return $this->render('HVGAccessControlBundle:AccessMonitor:index.html.twig', array(
            'community' => $community,
            'communityevents' => $communityevents,
            'checkpoint' => $checkpoint,
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

    public function searchAction(Request $request, $hash, Checkpoint $checkpoint, AccessGuard $accessguard)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);

        $searchForm = $this->createForm(new SearchType());
        $searchForm->handleRequest($request);

        if ($searchForm->isSubmitted()) {
            if($searchForm->isValid()) {
                $search = $searchForm['search']->getData();
                $unitresidents = $em->getRepository('HVGSystemBundle:UnitResident')->findBySearch($community, $search);
                $unitmemos = $em->getRepository('HVGSystemBundle:UnitMemo')->findBySearch($community, $search);
                $guests = $em->getRepository('HVGSystemBundle:Guest')->findBySearch($community, $search);

                return $this->render('HVGAccessControlBundle:AccessMonitor:search.html.twig', array(
                    'community' => $community,
                    'checkpoint' => $checkpoint,
                    'accessguard' => $accessguard,
                    'unitresidents' => $unitresidents,
                    'unitmemos' => $unitmemos,
                    'guests' => $guests,
                    'searchForm' => $searchForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('accesscontrol_accessmonitor_index', array('hash' => $hash, 'checkpoint' => $checkpoint->getId(), 'accessguard' => $accessguard->getId())));

    }
}
