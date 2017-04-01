<?php

namespace HVG\SystemBundle\Controller;

use HVG\SystemBundle\Entity\Area;
use HVG\SystemBundle\Form\AreaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Area controller.
 *
 */
class AreaController extends Controller
{

    /**
     * Lists all Area entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $areas = $em->getRepository('HVGSystemBundle:Area')->findBy(array(), array($sort => $direction));
        else $areas = $em->getRepository('HVGSystemBundle:Area')->findAll();
        $paginator = $this->get('knp_paginator');
        $areas = $paginator->paginate($areas, $request->query->getInt('page', 1), 100);
        $area = new Area();
        $newForm = $this->createNewForm($area)->createView();

        $editForms = array();
        $deleteForms = array();
        foreach($areas as $key => $area) {
            $editForms[] = $this->createEditForm($area)->createView();
            $deleteForms[] = $this->createDeleteForm($area)->createView();
        }

        return $this->render('area/index.html.twig', array(
            'areas' => $areas,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Area entity.
     *
     */
    public function newAction(Request $request)
    {
        $area = new Area();
        $newForm = $this->createNewForm($area);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($area);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'area.flash.created' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to create a new Area entity.
     *
     * @param Area $area The Area entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Area $area)
    {
        return $this->createForm('HVG\SystemBundle\Form\AreaType', $area, array(
            'action' => $this->generateUrl('area_new'),
        ));
    }

    /**
     * Finds and displays a Area entity.
     *
     */
    public function showAction(Area $area)
    {
        $editForm = $this->createEditForm($area);
        $deleteForm = $this->createDeleteForm($area);

        return $this->render('area/show.html.twig', array(
            'area' => $area,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Area entity.
     *
     */
    public function editAction(Request $request, Area $area)
    {
        $editForm = $this->createEditForm($area);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($area);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'area.flash.updated' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to edit a Area entity.
     *
     * @param Area $area The Area entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Area $area)
    {
        return $this->createForm('HVG\SystemBundle\Form\AreaType', $area, array(
            'action' => $this->generateUrl('area_edit', array('id' => $area->getId())),
        ));
    }

    /**
     * Deletes a Area entity.
     *
     */
    public function deleteAction(Request $request, Area $area)
    {
        $deleteForm = $this->createDeleteForm($area);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($area);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'area.flash.deleted' );    
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a Area entity.
     *
     * @param Area $area The Area entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Area $area)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('area_delete', array('id' => $area->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
