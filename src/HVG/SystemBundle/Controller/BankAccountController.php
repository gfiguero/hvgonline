<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\BankAccount;
use HVG\SystemBundle\Form\BankAccountType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Bankaccount controller.
 *
 */
class BankAccountController extends Controller
{

    /**
     * Lists all BankAccount entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $bankAccounts = $em->getRepository('HVGSystemBundle:BankAccount')->findBy(array(), array($sort => $direction));
        else $bankAccounts = $em->getRepository('HVGSystemBundle:BankAccount')->findAll();
        $paginator = $this->get('knp_paginator');
        $bankAccounts = $paginator->paginate($bankAccounts, $request->query->getInt('page', 1), 100);
        $bankAccount = new BankAccount();
        $newForm = $this->createNewForm($bankAccount)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($bankAccounts as $key => $bankAccount) {
            $editForms[] = $this->createEditForm($bankAccount)->createView();
            $deleteForms[] = $this->createDeleteForm($bankAccount)->createView();
        }

        return $this->render('bankaccount/index.html.twig', array(
            'bankAccounts' => $bankAccounts,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new BankAccount entity.
     *
     */
    public function newAction(Request $request)
    {
        $bankAccount = new BankAccount();
        $newForm = $this->createNewForm($bankAccount);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bankAccount);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'bankAccount.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new BankAccount entity.
     *
     * @param BankAccount $bankAccount The BankAccount entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(BankAccount $bankAccount)
    {
        return $this->createForm('HVG\SystemBundle\Form\BankAccountType', $bankAccount, array(
            'action' => $this->generateUrl('bankaccount_new'),
        ));
    }

    /**
     * Finds and displays a BankAccount entity.
     *
     */
    public function showAction(BankAccount $bankAccount)
    {
        $editForm = $this->createEditForm($bankAccount);
        $deleteForm = $this->createDeleteForm($bankAccount);

        return $this->render('bankaccount/show.html.twig', array(
            'bankAccount' => $bankAccount,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing BankAccount entity.
     *
     */
    public function editAction(Request $request, BankAccount $bankAccount)
    {
        $editForm = $this->createEditForm($bankAccount);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bankAccount);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'bankAccount.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a BankAccount entity.
     *
     * @param BankAccount $bankAccount The BankAccount entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(BankAccount $bankAccount)
    {
        return $this->createForm('HVG\SystemBundle\Form\BankAccountType', $bankAccount, array(
            'action' => $this->generateUrl('bankaccount_edit', array('id' => $bankAccount->getId())),
        ));
    }

    /**
     * Deletes a BankAccount entity.
     *
     */
    public function deleteAction(Request $request, BankAccount $bankAccount)
    {
        $deleteForm = $this->createDeleteForm($bankAccount);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bankAccount);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'bankAccount.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a BankAccount entity.
     *
     * @param BankAccount $bankAccount The BankAccount entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BankAccount $bankAccount)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bankaccount_delete', array('id' => $bankAccount->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
