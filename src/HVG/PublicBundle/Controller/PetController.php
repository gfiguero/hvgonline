<?php

namespace HVG\PublicBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\Pet;
use HVG\PublicBundle\Form\PetType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PetController extends Controller
{
    public function newAction(Request $request, $hash)
    {
        $em = $this->getDoctrine()->getManager();
        $community = $em->getRepository('HVGSystemBundle:Community')->findOneByHash($hash);

        $pet = new Pet();
        $newForm = $this->createForm(new PetType(), $pet, array('community' => $community));
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $owner = $pet->getOwner();
                $existentPerson = $em->getRepository('HVGSystemBundle:Person')->findOneByRut($owner->getRut());
                if ($existentPerson) {
                    $existentPerson->setName(ucwords($owner->getName()));
                    $em->merge($existentPerson);
                    $pet->setOwner($existentPerson);
                } else {
                    $owner->setName(ucwords($owner->getName()));
                }
                $em->persist($pet);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'pet.new.flash' );
                return $this->redirect($this->generateUrl('public_dashboard_index', array('hash' => $hash)));
            }
        }

        return $this->render('HVGPublicBundle:Pet:new.html.twig', array(
            'newForm' => $newForm->createView(),
            'community' => $community,
        ));
    }
}
