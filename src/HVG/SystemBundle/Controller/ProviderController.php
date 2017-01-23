<?php

namespace HVG\SystemBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HVG\SystemBundle\Entity\Provider;
use HVG\SystemBundle\Form\ProviderType;

class ProviderController extends Controller
{
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $providers = $em->getRepository('HVGSystemBundle:Provider')->findBy(array(), array($sort => $direction));
        else $providers = $em->getRepository('HVGSystemBundle:Provider')->findAll();
        $paginator = $this->get('knp_paginator');
        $providers = $paginator->paginate($providers, $request->query->getInt('page', 1), 24);

        $deleteForms = array();
        $editForms = array();
        $provider = new Provider();
        $newForm = $this->createForm('HVG\SystemBundle\Form\ProviderType', $provider, array(
            'action' => $this->generateUrl('provider_new'),
        ))->createView();

        foreach ($providers as $key => $provider) {
            $editForms[] = $this->createForm('HVG\SystemBundle\Form\ProviderType', $provider, array(
                'action' => $this->generateUrl('provider_edit', array('id' => $provider->getId())),
            ))->createView();
            $deleteForms[] = $this->createDeleteForm($provider, array(
                'action' => $this->generateUrl('provider_delete', array('id' => $provider->getId())),
            ))->createView();
        }

        return $this->render('HVGSystemBundle:Provider:index.html.twig', array(
            'providers' => $providers,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Provider entity.
     *
     */
    public function newAction(Request $request)
    {
        $provider = new Provider();
        $form = $this->createForm('HVG\SystemBundle\Form\ProviderType', $provider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($provider);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'provider.new.flash' );

        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Displays a form to edit an existing Provider entity.
     *
     */
    public function editAction(Request $request, Provider $provider)
    {
        $deleteForm = $this->createDeleteForm($provider);
        $editForm = $this->createForm('HVG\SystemBundle\Form\ProviderType', $provider);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($provider);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'provider.edit.flash' );

            return $this->redirect($request->headers->get('referer'));
        }

        return $this->render('provider/edit.html.twig', array(
            'provider' => $provider,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Provider entity.
     *
     */
    public function deleteAction(Request $request, Provider $provider)
    {
        $form = $this->createDeleteForm($provider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($provider);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'provider.delete.flash' );
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a Provider entity.
     *
     * @param Provider $provider The Provider entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Provider $provider)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('provider_delete', array('id' => $provider->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
