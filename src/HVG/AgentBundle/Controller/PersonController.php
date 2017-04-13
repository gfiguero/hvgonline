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
        $deleteForms = array();
        foreach($people as $key => $person) {
            $editForms[] = $this->createEditForm($person)->createView();
            $deleteForms[] = $this->createDeleteForm($person)->createView();
        }

        return $this->render('HVGAgentBundle:Person:index.html.twig', array(
            'people' => $people,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));

    }

    public function showAction(Person $person)
    {
        $editForm = $this->createEditForm($person);
        $deleteForm = $this->createDeleteForm($person);

        return $this->render('HVGAgentBundle:Person:show.html.twig', array(
            'person' => $person,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    private function createNewForm(Person $person)
    {
        return $this->createForm('HVG\SystemBundle\Form\PersonType', $person, array(
            'action' => $this->generateUrl('person_new'),
        ));
    }
    private function createEditForm(Person $person)
    {
        return $this->createForm('HVG\SystemBundle\Form\PersonType', $person, array(
            'action' => $this->generateUrl('person_edit', array('id' => $person->getId())),
        ));
    }
    private function createDeleteForm(Person $person)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('person_delete', array('id' => $person->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

}
