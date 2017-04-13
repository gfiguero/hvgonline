<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\CommunityStaff;
use HVG\SystemBundle\Form\CommunityStaffType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Communitystaff controller.
 *
 */
class CommunityStaffController extends Controller
{

    /**
     * Lists all CommunityStaff entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $communityStaffs = $em->getRepository('HVGSystemBundle:CommunityStaff')->findBy(array(), array($sort => $direction));
        else $communityStaffs = $em->getRepository('HVGSystemBundle:CommunityStaff')->findAll();
        $paginator = $this->get('knp_paginator');
        $communityStaffs = $paginator->paginate($communityStaffs, $request->query->getInt('page', 1), 100);
        $communityStaff = new CommunityStaff();
        $newForm = $this->createNewForm($communityStaff)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($communityStaffs as $key => $communityStaff) {
            $editForms[] = $this->createEditForm($communityStaff)->createView();
            $deleteForms[] = $this->createDeleteForm($communityStaff)->createView();
        }

        return $this->render('communitystaff/index.html.twig', array(
            'communityStaffs' => $communityStaffs,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new CommunityStaff entity.
     *
     */
    public function newAction(Request $request)
    {
        $communityStaff = new CommunityStaff();
        $newForm = $this->createNewForm($communityStaff);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($communityStaff);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'communityStaff.flash.created' );
            } else {
                return $this->render('communitystaff/new.html.twig', array(
                    'communityStaff' => $communityStaff,
                    'newForm' => $newForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('communitystaff_index'));
    }

    /**
     * Creates a form to create a new CommunityStaff entity.
     *
     * @param CommunityStaff $communityStaff The CommunityStaff entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(CommunityStaff $communityStaff)
    {
        return $this->createForm('HVG\SystemBundle\Form\CommunityStaffType', $communityStaff, array(
            'action' => $this->generateUrl('communitystaff_new'),
        ));
    }

    /**
     * Finds and displays a CommunityStaff entity.
     *
     */
    public function showAction(CommunityStaff $communityStaff)
    {
        $editForm = $this->createEditForm($communityStaff);
        $deleteForm = $this->createDeleteForm($communityStaff);

        return $this->render('communitystaff/show.html.twig', array(
            'communityStaff' => $communityStaff,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CommunityStaff entity.
     *
     */
    public function editAction(Request $request, CommunityStaff $communityStaff)
    {
        $editForm = $this->createEditForm($communityStaff);
        $deleteForm = $this->createDeleteForm($communityStaff);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($communityStaff);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'communityStaff.flash.updated' );
            } else {
                return $this->render('communitystaff/edit.html.twig', array(
                    'communityStaff' => $communityStaff,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('communitystaff_index'));
    }

    /**
     * Creates a form to edit a CommunityStaff entity.
     *
     * @param CommunityStaff $communityStaff The CommunityStaff entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(CommunityStaff $communityStaff)
    {
        return $this->createForm('HVG\SystemBundle\Form\CommunityStaffType', $communityStaff, array(
            'action' => $this->generateUrl('communitystaff_edit', array('id' => $communityStaff->getId())),
        ));
    }

    /**
     * Deletes a CommunityStaff entity.
     *
     */
    public function deleteAction(Request $request, CommunityStaff $communityStaff)
    {
        $deleteForm = $this->createDeleteForm($communityStaff);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($communityStaff);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'communityStaff.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('communitystaff_index'));
    }

    /**
     * Creates a form to delete a CommunityStaff entity.
     *
     * @param CommunityStaff $communityStaff The CommunityStaff entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CommunityStaff $communityStaff)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('communitystaff_delete', array('id' => $communityStaff->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
