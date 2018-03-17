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

                $email = $pet->getEmail();
                if($email) {
                    $message = new \Swift_Message($pet->getUnit()->getCommunity() . ' - Registro de mascota');
                    $message->setFrom('orion@hvg.cl', 'HVG Administraciones');
                    $message->setTo($email);
                    $message->setEncoder(\Swift_Encoding::get8BitEncoding());
                    $message->setBody($this->renderView('HVGPublicBundle:Email:pet.html.twig', array('pet' => $pet)), 'text/html');
                    $this->get('mailer')->send($message);
                }

                $request->getSession()->getFlashBag()->add( 'success', 'pet.new.flash' );
                return $this->redirect($this->generateUrl('public_dashboard_index', array('hash' => $hash)));
            }
        }

        return $this->render('HVGPublicBundle:Pet:new.html.twig', array(
            'newForm' => $newForm->createView(),
            'community' => $community,
        ));
    }

    public function testAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $pet = $em->getRepository('HVGSystemBundle:Pet')->find(1);
        
        return $this->render('HVGPublicBundle:Email:pet.html.twig', array(
            'pet' => $pet,
        ));
    }
}
