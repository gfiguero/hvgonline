<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Bank;
use HVG\SystemBundle\Form\BankType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Bank controller.
 *
 */
class BankController extends Controller
{

    /**
     * Lists all Bank entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $banks = $em->getRepository('HVGSystemBundle:Bank')->findBy(array(), array($sort => $direction));
        else $banks = $em->getRepository('HVGSystemBundle:Bank')->findAll();
        $paginator = $this->get('knp_paginator');
        $banks = $paginator->paginate($banks, $request->query->getInt('page', 1), 100);
        $bank = new Bank();
        $newForm = $this->createNewForm($bank)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($banks as $key => $bank) {
            $editForms[] = $this->createEditForm($bank)->createView();
            $deleteForms[] = $this->createDeleteForm($bank)->createView();
        }

        return $this->render('bank/index.html.twig', array(
            'banks' => $banks,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Bank entity.
     *
     */
    public function newAction(Request $request)
    {
        $bank = new Bank();
        $newForm = $this->createNewForm($bank);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($bank);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'bank.flash.created' );
            } else {
                return $this->render('bank/new.html.twig', array(
                    'bank' => $bank,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('bank_index'));
    }

    /**
     * Creates a form to create a new Bank entity.
     *
     * @param Bank $bank The Bank entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Bank $bank)
    {
        return $this->createForm('HVG\SystemBundle\Form\BankType', $bank, array(
            'action' => $this->generateUrl('bank_new'),
        ));
    }

    /**
     * Finds and displays a Bank entity.
     *
     */
    public function showAction(Bank $bank)
    {
        $editForm = $this->createEditForm($bank);
        $deleteForm = $this->createDeleteForm($bank);

        return $this->render('bank/show.html.twig', array(
            'bank' => $bank,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Bank entity.
     *
     */
    public function editAction(Request $request, Bank $bank)
    {
        $editForm = $this->createEditForm($bank);
        $deleteForm = $this->createDeleteForm($bank);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($bank);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'bank.flash.updated' );
            } else {
                return $this->render('bank/edit.html.twig', array(
                    'bank' => $bank,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('bank_index'));
    }

    /**
     * Creates a form to edit a Bank entity.
     *
     * @param Bank $bank The Bank entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Bank $bank)
    {
        return $this->createForm('HVG\SystemBundle\Form\BankType', $bank, array(
            'action' => $this->generateUrl('bank_edit', array('id' => $bank->getId())),
        ));
    }

    /**
     * Deletes a Bank entity.
     *
     */
    public function deleteAction(Request $request, Bank $bank)
    {
        $deleteForm = $this->createDeleteForm($bank);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bank);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'bank.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('bank_index'));
    }

    /**
     * Creates a form to delete a Bank entity.
     *
     * @param Bank $bank The Bank entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Bank $bank)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bank_delete', array('id' => $bank->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
