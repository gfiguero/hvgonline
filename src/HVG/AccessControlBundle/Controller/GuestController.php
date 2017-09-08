<?php

namespace HVG\AccessControlBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\Guest;
use HVG\SystemBundle\Entity\Person;
use HVG\AccessControlBundle\Form\GuestType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class GuestController extends Controller
{
    public function linksAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();
        return $this->render('HVGAccessControlBundle:Guest:links.html.twig', array(
            'communities' => $communities,
        ));
    }

    public function indexAction(Request $request, $hash)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);
        $guests = $em->getRepository('HVGSystemBundle:Guest')->findByCommunity($community);
        return $this->render('HVGAccessControlBundle:Guest:index.html.twig', array(
            'guests' => $guests,
        ));
    }

    public function newAction(Request $request, $hash)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);
        $guest = new Guest();
        $newForm = $this->createForm(new GuestType(), $guest, array('community' => $community));
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
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
                $request->getSession()->getFlashBag()->add( 'success', 'guest.new.flash' );
                return $this->redirect($this->generateUrl('accesscontrol_guest_new', array('hash' => $hash)));
                return $this->render('HVGAccessControlBundle:Guest:finish.html.twig', array(
                    'community' => $community,
                ));
            }
        }

        return $this->render('HVGAccessControlBundle:Guest:new.html.twig', array(
            'newForm' => $newForm->createView(),
            'community' => $community,
        ));
    }
    public function testAction(Request $request)
    {
        return $this->render('HVGAccessControlBundle:Guest:test.html.twig', array(
        ));
    }
    public function searchPersonAction(Request $request)
    {
        $rut = $request->query->get('rut');
        $em = $this->getDoctrine()->getManager();
        $people = $em->getRepository('HVGSystemBundle:Person')->searchByRut($rut);
        return new JsonResponse($people);

    }
    public function searchResidentsAction(Request $request)
    {
        $unit = $request->query->get('unit');
        $em = $this->getDoctrine()->getManager();
        $residents = $em->getRepository('HVGSystemBundle:Resident')->findByUnit($unit);
        return new JsonResponse($residents);
    }
}
