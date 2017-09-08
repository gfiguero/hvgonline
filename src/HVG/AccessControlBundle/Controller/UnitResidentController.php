<?php

namespace HVG\AccessControlBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\Guest;
use HVG\SystemBundle\Entity\Unit;
use HVG\AccessControlBundle\Form\GuestType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class UnitResidentController extends Controller
{
    public function searchByUnitAction(Request $request, Unit $unit)
    {
        $em = $this->getDoctrine()->getManager();
        $residents = $em->getRepository('HVGSystemBundle:UnitResident')->findNameByUnit($unit);
        return new JsonResponse($residents);
    }
}
