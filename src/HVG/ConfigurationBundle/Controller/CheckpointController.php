<?php

namespace HVG\ConfigurationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use HVG\SystemBundle\Entity\Checkpoint;
use HVG\ConfigurationBundle\Form\CheckpointType;

class CheckpointController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $sort = $request->query->has('sort') ? $request->query->get('sort') : 'createdAt';
        $direction = $request->query->has('direction') ? $request->query->get('direction') : 'DESC';

        $checkpoints = $em->getRepository('HVGSystemBundle:Checkpoint')->findAll();

        $paginator = $this->get('knp_paginator');
        $checkpoints = $paginator->paginate($checkpoints, $request->query->getInt('page', 1), 100);

        return $this->render('HVGConfigurationBundle:Checkpoint:index.html.twig', array(
            'checkpoints' => $checkpoints,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    public function newAction(Request $request)
    {
        $checkpoint = new Checkpoint();
        $newForm = $this->createForm(new CheckpointType(), $checkpoint);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($checkpoint);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'checkpoint.new.flash' );
                return $this->redirect($this->generateUrl('configuration_checkpoint_index'));
            }
        }

        return $this->render('HVGConfigurationBundle:Checkpoint:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    public function showAction(Checkpoint $checkpoint)
    {
        return $this->render('HVGConfigurationBundle:Checkpoint:show.html.twig', array(
            'checkpoint' => $checkpoint,
        ));
    }

    public function editAction(Request $request, Checkpoint $checkpoint)
    {
        $editForm = $this->createForm(new CheckpointType(), $checkpoint);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($checkpoint);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'checkpoint.edit.flash' );
                return $this->redirect($this->generateUrl('configuration_checkpoint_index'));
            }
        }

        return $this->render('HVGConfigurationBundle:Checkpoint:edit.html.twig', array(
            'editForm' => $editForm->createView(),
        ));
    }

    public function deleteAction(Request $request, Checkpoint $checkpoint)
    {
        $deleteForm = $this->createFormBuilder()->setMethod('DELETE')->getForm();
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted()) {
            if($deleteForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($checkpoint);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'danger', 'checkpoint.delete.flash' );
                return $this->redirect($this->generateUrl('configuration_checkpoint_index'));
            }
        }

        return $this->render('HVGConfigurationBundle:Checkpoint:delete.html.twig', array(
            'checkpoint' => $checkpoint,
            'deleteForm' => $deleteForm->createView(),
        ));
    }

}
