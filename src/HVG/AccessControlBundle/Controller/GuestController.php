<?php

namespace HVG\AccessControlBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\Guest;
use HVG\SystemBundle\Entity\Person;
use HVG\SystemBundle\Entity\Checkpoint;
use HVG\SystemBundle\Entity\AccessGuard;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\AccessControlBundle\Form\GuestType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class GuestController extends Controller
{
    public function indexAction(Request $request, $hash, Checkpoint $checkpoint, AccessGuard $accessguard)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);
        $guests = $em->getRepository('HVGSystemBundle:Guest')->getLastByCommunity($community);
        return $this->render('HVGAccessControlBundle:Guest:index.html.twig', array(
            'guests' => $guests,
            'community' => $community,
            'checkpoint' => $checkpoint,
            'accessguard' => $accessguard,
        ));
    }

    public function newAction(Request $request, $hash, Checkpoint $checkpoint, AccessGuard $accessguard, UnitGroup $unitgroup, Unit $unit)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);

        $guest = new Guest();
        $newForm = $this->createForm(new GuestType(), $guest, array('community' => $community));
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $guest->setUnit($unit);
                $guest->setCheckpoint($checkpoint);
                $guest->setAccessguard($accessguard);
                $guest->setCarLicence(strtoupper($guest->getCarLicence()));
                $people = $guest->getPeople();
                $em = $this->getDoctrine()->getManager();
                foreach ($people as $person) {
                    $existentPerson = $em->getRepository('HVGSystemBundle:Person')->findOneByRut($person->getRut());
                    if ($existentPerson) {
                        $guest->removePerson($person);
                        $guest->addPerson($existentPerson);
                    }
                }
                $em->persist($guest);
                $em->flush();
                //$request->getSession()->getFlashBag()->add( 'success', 'guest.new.flash' );
                return $this->redirect($this->generateUrl('accesscontrol_accessmonitor_index', array('hash' => $hash, 'checkpoint' => $checkpoint->getId(), 'accessguard' => $accessguard->getId(), 'unitgroup' => $unitgroup->getId(), 'unit' => $unit->getId())));
            }
        }

        $person = new Person();
        $guest->addPerson($person);
        $newForm->setData($guest);

        return $this->render('HVGAccessControlBundle:Guest:new.html.twig', array(
            'newForm' => $newForm->createView(),
            'community' => $community,
            'checkpoint' => $checkpoint,
            'accessguard' => $accessguard,
            'unitgroup' => $unitgroup,
            'unit' => $unit,
        ));
    }

    public function searchPersonAction(Request $request)
    {
        $rut = $request->query->get('rut');
        $em = $this->getDoctrine()->getManager();
        $person = $em->getRepository('HVGSystemBundle:Person')->findOneByRut($rut);
        $result['status'] = $person ? 0 : 1;
        $result['name'] = $person ? $person->getName() : '';
        return new JsonResponse($result);
    }
}
