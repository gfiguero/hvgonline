<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\ProviderService;
use HVG\SystemBundle\Form\ProviderServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Providerservice controller.
 *
 */
class ProviderServiceController extends Controller
{

    /**
     * Lists all ProviderService entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $providerServices = $em->getRepository('HVGSystemBundle:ProviderService')->findBy(array(), array($sort => $direction));
        else $providerServices = $em->getRepository('HVGSystemBundle:ProviderService')->findAll();
        $paginator = $this->get('knp_paginator');
        $providerServices = $paginator->paginate($providerServices, $request->query->getInt('page', 1), 100);
        $providerService = new ProviderService();
        $newForm = $this->createNewForm($providerService)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($providerServices as $key => $providerService) {
            $editForms[] = $this->createEditForm($providerService)->createView();
            $deleteForms[] = $this->createDeleteForm($providerService)->createView();
        }

        return $this->render('providerservice/index.html.twig', array(
            'providerServices' => $providerServices,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new ProviderService entity.
     *
     */
    public function newAction(Request $request)
    {
        $providerService = new ProviderService();
        $newForm = $this->createNewForm($providerService);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($providerService);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'providerService.flash.created' );
            } else {
                return $this->render('providerservice/new.html.twig', array(
                    'providerService' => $providerService,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('providerservice_index'));
    }

    /**
     * Creates a form to create a new ProviderService entity.
     *
     * @param ProviderService $providerService The ProviderService entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(ProviderService $providerService)
    {
        return $this->createForm('HVG\SystemBundle\Form\ProviderServiceType', $providerService, array(
            'action' => $this->generateUrl('providerservice_new'),
        ));
    }

    /**
     * Finds and displays a ProviderService entity.
     *
     */
    public function showAction(ProviderService $providerService)
    {
        $editForm = $this->createEditForm($providerService);
        $deleteForm = $this->createDeleteForm($providerService);

        return $this->render('providerservice/show.html.twig', array(
            'providerService' => $providerService,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProviderService entity.
     *
     */
    public function editAction(Request $request, ProviderService $providerService)
    {
        $editForm = $this->createEditForm($providerService);
        $deleteForm = $this->createDeleteForm($providerService);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($providerService);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'providerService.flash.updated' );
            } else {
                return $this->render('providerservice/edit.html.twig', array(
                    'providerService' => $providerService,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('providerservice_index'));
    }

    /**
     * Creates a form to edit a ProviderService entity.
     *
     * @param ProviderService $providerService The ProviderService entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(ProviderService $providerService)
    {
        return $this->createForm('HVG\SystemBundle\Form\ProviderServiceType', $providerService, array(
            'action' => $this->generateUrl('providerservice_edit', array('id' => $providerService->getId())),
        ));
    }

    /**
     * Deletes a ProviderService entity.
     *
     */
    public function deleteAction(Request $request, ProviderService $providerService)
    {
        $deleteForm = $this->createDeleteForm($providerService);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($providerService);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'providerService.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('providerservice_index'));
    }

    /**
     * Creates a form to delete a ProviderService entity.
     *
     * @param ProviderService $providerService The ProviderService entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProviderService $providerService)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('providerservice_delete', array('id' => $providerService->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
