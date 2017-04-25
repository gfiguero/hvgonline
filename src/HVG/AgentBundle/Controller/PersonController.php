<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PersonController extends Controller
{
    public function indexAction(Request $request)
    {

        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $people = $em->getRepository('HVGSystemBundle:Person')->findBy(array(), array($sort => $direction));
        else $people = $em->getRepository('HVGSystemBundle:Person')->findAll();
        $paginator = $this->get('knp_paginator');
        $people = $paginator->paginate($people, $request->query->getInt('page', 1), 100);
        $person = new Person();
        $newForm = $this->createNewForm($person)->createView();
        $editForms = array();
        foreach($people as $key => $person) {
            $editForms[] = $this->createEditForm($person)->createView();
        }
        return $this->render('HVGAgentBundle:Person:index.html.twig', array(
            'people' => $people,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
        ));
    }

    public function newAction(Request $request)
    {
        $person = new Person();
        $newForm = $this->createNewForm($person);
        $newForm->handleRequest($request);
        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($person);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'person.flash.created' );
            } else {
                return $this->render('HVGAgentBundle:Person:new.html.twig', array(
                    'person' => $person,
                    'newForm' => $newForm->createView(),
                ));
            }
        }
        return $this->redirect($this->generateUrl('agent_person_index'));
    }

    public function editAction(Request $request, Person $person)
    {
        $editForm = $this->createEditForm($person);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($person);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'person.flash.updated' );
                return $this->redirect($this->generateUrl('agent_person_index'));
            }
        }
        return $this->render('HVGAgentBundle:Person:edit.html.twig', array(
            'person' => $person,
            'editForm' => $editForm->createView(),
        ));
    }

    public function showAction(Person $person)
    {
        $editForm = $this->createEditForm($person);
        return $this->render('HVGAgentBundle:Person:show.html.twig', array(
            'person' => $person,
            'editForm' => $editForm->createView(),
        ));
    }

    private function createNewForm(Person $person)
    {
        return $this->createForm('HVG\AgentBundle\Form\PersonType', $person, array(
            'action' => $this->generateUrl('agent_person_new'),
        ));
    }

    private function createEditForm(Person $person)
    {
        return $this->createForm('HVG\AgentBundle\Form\PersonType', $person, array(
            'action' => $this->generateUrl('agent_person_edit', array('id' => $person->getId())),
        ));
    }

}
