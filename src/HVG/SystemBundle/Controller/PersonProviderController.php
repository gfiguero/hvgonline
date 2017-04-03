<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\PersonProvider;
use HVG\SystemBundle\Form\PersonProviderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Personprovider controller.
 *
 */
class PersonProviderController extends Controller
{

    /**
     * Lists all PersonProvider entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $personProviders = $em->getRepository('HVGSystemBundle:PersonProvider')->findBy(array(), array($sort => $direction));
        else $personProviders = $em->getRepository('HVGSystemBundle:PersonProvider')->findAll();
        $paginator = $this->get('knp_paginator');
        $personProviders = $paginator->paginate($personProviders, $request->query->getInt('page', 1), 100);
        $personProvider = new PersonProvider();
        $newForm = $this->createNewForm($personProvider)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($personProviders as $key => $personProvider) {
            $editForms[] = $this->createEditForm($personProvider)->createView();
            $deleteForms[] = $this->createDeleteForm($personProvider)->createView();
        }

        return $this->render('personprovider/index.html.twig', array(
            'personProviders' => $personProviders,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new PersonProvider entity.
     *
     */
    public function newAction(Request $request)
    {
        $personProvider = new PersonProvider();
        $newForm = $this->createNewForm($personProvider);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($personProvider);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'personProvider.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new PersonProvider entity.
     *
     * @param PersonProvider $personProvider The PersonProvider entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(PersonProvider $personProvider)
    {
        return $this->createForm('HVG\SystemBundle\Form\PersonProviderType', $personProvider, array(
            'action' => $this->generateUrl('personprovider_new'),
        ));
    }

    /**
     * Finds and displays a PersonProvider entity.
     *
     */
    public function showAction(PersonProvider $personProvider)
    {
        $editForm = $this->createEditForm($personProvider);
        $deleteForm = $this->createDeleteForm($personProvider);

        return $this->render('personprovider/show.html.twig', array(
            'personProvider' => $personProvider,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PersonProvider entity.
     *
     */
    public function editAction(Request $request, PersonProvider $personProvider)
    {
        $editForm = $this->createEditForm($personProvider);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($personProvider);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'personProvider.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a PersonProvider entity.
     *
     * @param PersonProvider $personProvider The PersonProvider entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(PersonProvider $personProvider)
    {
        return $this->createForm('HVG\SystemBundle\Form\PersonProviderType', $personProvider, array(
            'action' => $this->generateUrl('personprovider_edit', array('id' => $personProvider->getId())),
        ));
    }

    /**
     * Deletes a PersonProvider entity.
     *
     */
    public function deleteAction(Request $request, PersonProvider $personProvider)
    {
        $deleteForm = $this->createDeleteForm($personProvider);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($personProvider);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'personProvider.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a PersonProvider entity.
     *
     * @param PersonProvider $personProvider The PersonProvider entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PersonProvider $personProvider)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('personprovider_delete', array('id' => $personProvider->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
