<?php

namespace HVG\SystemBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HVG\SystemBundle\Entity\BankAccount;
use HVG\SystemBundle\Form\BankAccountType;

class BankAccountController extends Controller
{
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $bankAccounts = $em->getRepository('HVGSystemBundle:BankAccount')->findBy(array(), array($sort => $direction));
        else $bankAccounts = $em->getRepository('HVGSystemBundle:BankAccount')->findAll();
        $paginator = $this->get('knp_paginator');
        $bankAccounts = $paginator->paginate($bankAccounts, $request->query->getInt('page', 1), 24);

        $deleteForms = array();
        $editForms = array();
        $bankAccount = new BankAccount();
        $newForm = $this->createForm('HVG\SystemBundle\Form\BankAccountType', $bankAccount, array(
            'action' => $this->generateUrl('bank_account_new'),
        ))->createView();

        foreach ($bankAccounts as $key => $bankAccount) {
            $editForms[] = $this->createForm('HVG\SystemBundle\Form\BankAccountType', $bankAccount, array(
                'action' => $this->generateUrl('bank_account_edit', array('id' => $bankAccount->getId())),
            ))->createView();
            $deleteForms[] = $this->createDeleteForm($bankAccount, array(
                'action' => $this->generateUrl('bank_account_delete', array('id' => $bankAccount->getId())),
            ))->createView();
        }

        return $this->render('HVGSystemBundle:BankAccount:index.html.twig', array(
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
        $form = $this->createForm('HVG\SystemBundle\Form\BankAccountType', $bankAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bankAccount);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'bankAccount.new.flash' );

        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Displays a form to edit an existing BankAccount entity.
     *
     */
    public function editAction(Request $request, BankAccount $bankAccount)
    {
        $deleteForm = $this->createDeleteForm($bankAccount);
        $editForm = $this->createForm('HVG\SystemBundle\Form\BankAccountType', $bankAccount);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bankAccount);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'bankAccount.edit.flash' );

            return $this->redirect($request->headers->get('referer'));
        }

        return $this->render('bankAccount/edit.html.twig', array(
            'bankAccount' => $bankAccount,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a BankAccount entity.
     *
     */
    public function deleteAction(Request $request, BankAccount $bankAccount)
    {
        $form = $this->createDeleteForm($bankAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bankAccount);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'bankAccount.delete.flash' );
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
            ->setAction($this->generateUrl('bank_account_delete', array('id' => $bankAccount->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
