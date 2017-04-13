<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\ProviderAccount;
use HVG\SystemBundle\Form\ProviderAccountType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Provideraccount controller.
 *
 */
class ProviderAccountController extends Controller
{

    /**
     * Lists all ProviderAccount entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $providerAccounts = $em->getRepository('HVGSystemBundle:ProviderAccount')->findBy(array(), array($sort => $direction));
        else $providerAccounts = $em->getRepository('HVGSystemBundle:ProviderAccount')->findAll();
        $paginator = $this->get('knp_paginator');
        $providerAccounts = $paginator->paginate($providerAccounts, $request->query->getInt('page', 1), 100);
        $providerAccount = new ProviderAccount();
        $newForm = $this->createNewForm($providerAccount)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($providerAccounts as $key => $providerAccount) {
            $editForms[] = $this->createEditForm($providerAccount)->createView();
            $deleteForms[] = $this->createDeleteForm($providerAccount)->createView();
        }

        return $this->render('provideraccount/index.html.twig', array(
            'providerAccounts' => $providerAccounts,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new ProviderAccount entity.
     *
     */
    public function newAction(Request $request)
    {
        $providerAccount = new ProviderAccount();
        $newForm = $this->createNewForm($providerAccount);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($providerAccount);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'providerAccount.flash.created' );
            } else {
                return $this->render('provideraccount/new.html.twig', array(
                    'providerAccount' => $providerAccount,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('provideraccount_index'));
    }

    /**
     * Creates a form to create a new ProviderAccount entity.
     *
     * @param ProviderAccount $providerAccount The ProviderAccount entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(ProviderAccount $providerAccount)
    {
        return $this->createForm('HVG\SystemBundle\Form\ProviderAccountType', $providerAccount, array(
            'action' => $this->generateUrl('provideraccount_new'),
        ));
    }

    /**
     * Finds and displays a ProviderAccount entity.
     *
     */
    public function showAction(ProviderAccount $providerAccount)
    {
        $editForm = $this->createEditForm($providerAccount);
        $deleteForm = $this->createDeleteForm($providerAccount);

        return $this->render('provideraccount/show.html.twig', array(
            'providerAccount' => $providerAccount,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProviderAccount entity.
     *
     */
    public function editAction(Request $request, ProviderAccount $providerAccount)
    {
        $editForm = $this->createEditForm($providerAccount);
        $deleteForm = $this->createDeleteForm($providerAccount);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($providerAccount);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'providerAccount.flash.updated' );
            } else {
                return $this->render('provideraccount/edit.html.twig', array(
                    'providerAccount' => $providerAccount,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('provideraccount_index'));
    }

    /**
     * Creates a form to edit a ProviderAccount entity.
     *
     * @param ProviderAccount $providerAccount The ProviderAccount entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(ProviderAccount $providerAccount)
    {
        return $this->createForm('HVG\SystemBundle\Form\ProviderAccountType', $providerAccount, array(
            'action' => $this->generateUrl('provideraccount_edit', array('id' => $providerAccount->getId())),
        ));
    }

    /**
     * Deletes a ProviderAccount entity.
     *
     */
    public function deleteAction(Request $request, ProviderAccount $providerAccount)
    {
        $deleteForm = $this->createDeleteForm($providerAccount);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($providerAccount);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'providerAccount.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('provideraccount_index'));
    }

    /**
     * Creates a form to delete a ProviderAccount entity.
     *
     * @param ProviderAccount $providerAccount The ProviderAccount entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProviderAccount $providerAccount)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('provideraccount_delete', array('id' => $providerAccount->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
