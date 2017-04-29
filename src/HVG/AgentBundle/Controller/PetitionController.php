<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Petition;
use HVG\AgentBundle\Form\PetitionType;

use HVG\SystemBundle\Entity\PetitionAction;
use HVG\SystemBundle\Entity\PetitionObjective;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PetitionController extends Controller
{
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $petitions = $em->getRepository('HVGSystemBundle:Petition')->findBy(array(), array($sort => $direction));
        else $petitions = $em->getRepository('HVGSystemBundle:Petition')->findAll();
        $paginator = $this->get('knp_paginator');
        $petitions = $paginator->paginate($petitions, $request->query->getInt('page', 1), 100);

        $petition = new Petition();
        $newForm = $this->createNewForm($petition);

        return $this->render('HVGAgentBundle:Petition:index.html.twig', array(
            'newForm' => $newForm->createView(),
            'petitions' => $petitions,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function newAction(Request $request)
    {
        $petition = new Petition();
        $newForm = $this->createNewForm($petition);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $petitionAction = new PetitionAction();
                $petitionAction->setPetition($petition);
                $petitionAction->setDescription('Requerimiento Creado. Estado: '.$petition->getPetitionStatus());
                $petitionAction->setUser($this->get('security.token_storage')->getToken()->getUser());

                $em = $this->getDoctrine()->getManager();
                $petition->setUser($this->get('security.token_storage')->getToken()->getUser());

                $em->persist($petition);
                $em->persist($petitionAction);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'petition.new.flash' );
                return $this->redirect($request->headers->get('referer'));
            }
        }

        return $this->render('HVGAgentBundle:Petition:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    public function editAction(Request $request, Petition $petition)
    {
        $editForm = $this->createEditForm($petition);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $petitionAction = new PetitionAction();
                $petitionAction->setPetition($petition);
                $petitionAction->setDescription('El requerimiento ha sido editado.');
                $petitionAction->setUser($this->get('security.token_storage')->getToken()->getUser());

                $em = $this->getDoctrine()->getManager();
                $em->persist($petition);
                $em->persist($petitionAction);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'petition.edit.flash' );
            }
        }

        return $this->redirect($request->headers->get('referer'));
    }

    public function statusAction(Request $request, Petition $petition)
    {
        $prevStatus = $petition->getPetitionStatus();
        $petitionStatusForm = $this->createStatusForm($petition);
        $petitionStatusForm->handleRequest($request);
        $postStatus = $petition->getPetitionStatus();

        if ($petitionStatusForm->isSubmitted()) {
            if($petitionStatusForm->isValid()) {
                $petitionAction = new PetitionAction();
                $petitionAction->setPetition($petition);
                $petitionAction->setDescription('El estado ha cambiado de ' . $prevStatus->getName() . ' a ' . $postStatus->getName() . '.');
                $petitionAction->setUser($this->get('security.token_storage')->getToken()->getUser());

                $em = $this->getDoctrine()->getManager();
                $em->persist($petition);
                $em->persist($petitionAction);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'petition.editstatus.flash' );
            }
        }

        return $this->redirect($request->headers->get('referer'));
    }

    public function addreferenceAction(Request $request, Petition $petition)
    {
        $referenceForm = $this->createReferenceForm($petition);
        $referenceForm->handleRequest($request);
        if ($referenceForm->isSubmitted()) {
            if($referenceForm->isValid()) {
                $petitionReferenceId = $referenceForm->getData('id');
                $em = $this->getDoctrine()->getManager();
                $petitionReference = $em->getRepository('HVGSystemBundle:Petition')->findOneById($petitionReferenceId);
                if($petitionReference) {
                    $petitionAction = new PetitionAction();
                    $petitionAction->setPetition($petition);
                    $petitionAction->setDescription('El el requerimiento ' . $petitionReference->getId() . ' ha sido referenciado.');
                    $petitionAction->setUser($this->get('security.token_storage')->getToken()->getUser());
                    $petition->addPetitionReference($petitionReference);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($petitionAction);
                    $em->persist($petition);
                    $em->flush();
                    $request->getSession()->getFlashBag()->add( 'success', 'petition.addreference.flash' );
                }
                else { 
                    $request->getSession()->getFlashBag()->add( 'danger', 'petition.addreference.flasherror' );
                }
            }
        }

        return $this->redirect($request->headers->get('referer'));
    }

    public function showAction(Petition $petition)
    {
        $petitionAction = new petitionAction();
        $petitionAction->setPetition($petition);
        $newActionForm = $this->createNewActionForm($petitionAction);
        $editForm = $this->createEditForm($petition)->remove('petitionstatus')->remove('petitionobjectives');
        $statusForm = $this->createStatusForm($petition);
        $referenceForm = $this->createReferenceForm($petition);

        return $this->render('HVGAgentBundle:Petition:show.html.twig', array(
            'petition' => $petition,
            'newActionForm' => $newActionForm->createView(),
            'editForm' => $editForm->createView(),
            'statusForm' => $statusForm->createView(),
            'referenceForm' => $referenceForm->createView(),
        ));
    }

    private function createStatusForm(Petition $petition)
    {
        return $this->createForm('HVG\AgentBundle\Form\PetitionStatusType', $petition, array(
            'action' => $this->generateUrl('agent_petition_status', array('id' => $petition->getId())),
        ));
    }

    private function createReferenceForm(Petition $petition)
    {
        return $this->createForm('HVG\AgentBundle\Form\PetitionReferenceType', null, array(
            'action' => $this->generateUrl('agent_petition_addreference', array('id' => $petition->getId())),
        ));
    }

    private function createEditForm(Petition $petition)
    {
        return $this->createForm('HVG\AgentBundle\Form\PetitionType', $petition, array(
            'action' => $this->generateUrl('agent_petition_edit', array('id' => $petition->getId())),
        ));
    }

    private function createNewForm(Petition $petition)
    {
        return $this->createForm('HVG\AgentBundle\Form\PetitionType', $petition, array(
            'action' => $this->generateUrl('agent_petition_new'),
        ));
    }

    private function createNewActionForm(PetitionAction $petitionAction)
    {
        return $this->createForm('HVG\AgentBundle\Form\PetitionActionType', $petitionAction, array(
            'action' => $this->generateUrl('agent_petitionaction_new'),
        ));
    }

    public function myAction(Request $request)
    {
        $user = $this->getUser();
        $areas = $user->getAreas();
        $communities = $user->getCommunities();
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        $statuses = $em->getRepository('HVGSystemBundle:PetitionStatus')->findBy(array('result' => array(1,2,3)));
        if($sort) $petitions = $em->getRepository('HVGSystemBundle:Petition')->findBy(array('area' => $areas->toArray(), 'community' => $communities->toArray(), 'petitionstatus' => $statuses), array($sort => $direction));
        else $petitions = $em->getRepository('HVGSystemBundle:Petition')->findBy(array('area' => $areas->toArray(), 'community' => $communities->toArray(), 'petitionstatus' => $statuses));
        $paginator = $this->get('knp_paginator');

        $petitions = $paginator->paginate($petitions, $request->query->getInt('page', 1), 100);
//        $petitions = $em->getRepository('HVGSystemBundle:Petition')->findMy($areas, $communities);

        $petition = new Petition();
        $newForm = $this->createNewForm($petition);
        $newForm->handleRequest($request);

        return $this->render('HVGAgentBundle:Petition:my.html.twig', array(
            'petitions' => $petitions,
            'newForm' => $newForm->createView(),
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function completeObjectiveAction(Request $request, PetitionObjective $petitionObjective)
    {
        $petitionObjective->setCompleted(true);
        $petition = $petitionObjective->getPetition();
        $petitionAction = new PetitionAction();
        $petitionAction->setPetition($petition);
        $petitionAction->setDescription("El objetivo '" . $petitionObjective->getDescription() . "' ha sido completado.");
        $petitionAction->setUser($this->get('security.token_storage')->getToken()->getUser());
        $petition->setUpdated();

        $em = $this->getDoctrine()->getManager();
        $em->persist($petitionAction);
        $em->persist($petitionObjective);
        $em->flush();
        return $this->redirect($request->headers->get('referer'));
    }
}
