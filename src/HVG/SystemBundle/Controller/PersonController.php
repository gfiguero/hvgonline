<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Person;
use HVG\SystemBundle\Form\PersonType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Person controller.
 *
 */
class PersonController extends Controller
{

    /**
     * Lists all Person entities.
     *
     */
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

        return $this->render('person/index.html.twig', array(
            'people' => $people,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Person entity.
     *
     */
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
                return $this->render('person/new.html.twig', array(
                    'person' => $person,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('person_index'));
    }

    /**
     * Creates a form to create a new Person entity.
     *
     * @param Person $person The Person entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Person $person)
    {
        return $this->createForm('HVG\SystemBundle\Form\PersonType', $person, array(
            'action' => $this->generateUrl('person_new'),
        ));
    }

    /**
     * Finds and displays a Person entity.
     *
     */
    public function showAction(Person $person)
    {
        $editForm = $this->createEditForm($person);
        $deleteForm = $this->createDeleteForm($person);

        return $this->render('person/show.html.twig', array(
            'person' => $person,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Person entity.
     *
     */
    public function editAction(Request $request, Person $person)
    {
        $editForm = $this->createEditForm($person);
        $deleteForm = $this->createDeleteForm($person);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($person);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'person.flash.updated' );
            } else {
                return $this->render('person/edit.html.twig', array(
                    'person' => $person,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('person_index'));
    }

    /**
     * Creates a form to edit a Person entity.
     *
     * @param Person $person The Person entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Person $person)
    {
        return $this->createForm('HVG\SystemBundle\Form\PersonType', $person, array(
            'action' => $this->generateUrl('person_edit', array('id' => $person->getId())),
        ));
    }

    /**
     * Deletes a Person entity.
     *
     */
    public function deleteAction(Request $request, Person $person)
    {
        $deleteForm = $this->createDeleteForm($person);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($person);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'person.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('person_index'));
    }

    /**
     * Creates a form to delete a Person entity.
     *
     * @param Person $person The Person entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Person $person)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('person_delete', array('id' => $person->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
