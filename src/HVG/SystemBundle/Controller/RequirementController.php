<?php

namespace HVG\SystemBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HVG\SystemBundle\Entity\Requirement;
use HVG\SystemBundle\Form\RequirementType;

use HVG\SystemBundle\Entity\RequirementComment;
use HVG\SystemBundle\Form\RequirementCommentType;

use HVG\SystemBundle\Entity\Filter;

class RequirementController extends Controller
{
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();
        
        $community = null;
        $filter = new Filter();
        $requirement = new Requirement();

        if($session->has('community')) {
            $community = $session->get('community');
            $filter->setCommunity($em->merge($community));
            $requirement->setCommunity($em->merge($community));
        }

        $filterForm = $this->createForm('HVG\SystemBundle\Form\FilterType', $filter, array( 'action' => $this->generateUrl('community_filter')))->createView();

        if($sort) $requirements = $em->getRepository('HVGSystemBundle:Requirement')->findBy(array('community' => $community), array($sort => $direction));
        else $requirements = $em->getRepository('HVGSystemBundle:Requirement')->findByCommunity($community);
        $paginator = $this->get('knp_paginator');
        $requirements = $paginator->paginate($requirements, $request->query->getInt('page', 1), 24);

        $deleteForms = array();
        $editForms = array();
        $newForm = $this->createForm('HVG\SystemBundle\Form\RequirementType', $requirement, array(
            'action' => $this->generateUrl('requirement_new'),
        ));
        $newForm = $newForm->remove('committal');
        $newForm = $newForm->add('committal', 'date', array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'requirement.form.committal',
                'translation_domain' => 'HVGSystemBundle',
                'data' => new \DateTime("now")))
        ;
        $newForm = $newForm->createView();

        foreach ($requirements as $key => $requirement) {
            $editForms[] = $this->createForm('HVG\SystemBundle\Form\RequirementType', $requirement, array(
                'action' => $this->generateUrl('requirement_edit', array('id' => $requirement->getId())),
            ))->createView();
            $deleteForms[] = $this->createDeleteForm($requirement, array(
                'action' => $this->generateUrl('requirement_delete', array('id' => $requirement->getId())),
            ))->createView();
        }


        return $this->render('HVGSystemBundle:Requirement:index.html.twig', array(
            'requirements' => $requirements,
            'direction' => $direction,
            'sort' => $sort,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
            'filterForm' => $filterForm,
        ));
    }

    /**
     * Finds and displays a City entity.
     *
     */
    public function showAction(Requirement $requirement)
    {
        $em = $this->getDoctrine()->getManager();
        $requirementComments = $em->getRepository('HVGSystemBundle:RequirementComment')->findByRequirement($requirement);
        $editStatusForm = $this->createForm('HVG\SystemBundle\Form\RequirementType', $requirement, array(
            'action' => $this->generateUrl('requirement_edit', array('id' => $requirement->getId())),
        ))->createView();
        $deleteForms = array();
        $editForms = array();
        $requirementComment = new RequirementComment();
        $requirementComment->setRequirement($requirement);
        $newForm = $this->createForm('HVG\SystemBundle\Form\RequirementCommentType', $requirementComment, array(
            'action' => $this->generateUrl('requirement_comment_new', array('id' => $requirement->getId())),
        ))->createView();

        foreach ($requirementComments as $key => $requirementComment) {
            $editForms[] = $this->createForm('HVG\SystemBundle\Form\RequirementCommentType', $requirementComment, array(
                'action' => $this->generateUrl('requirement_comment_edit', array('id' => $requirementComment->getId())),
            ))->createView();
            $deleteForms[] = $this->createDeleteCommentForm($requirementComment, array(
                'action' => $this->generateUrl('requirement_comment_delete', array('id' => $requirementComment->getId())),
            ))->createView();
        }

        return $this->render('HVGSystemBundle:Requirement:show.html.twig', array(
            'requirement' => $requirement,
            'requirementComments' => $requirementComments,
            'newForm' => $newForm,
            'editForms' => $editForms,
            'deleteForms' => $deleteForms,
            'editStatusForm' => $editStatusForm,
        ));
    }

    /**
     * Creates a new Requirement entity.
     *
     */
    public function newAction(Request $request)
    {
        $requirement = new Requirement();
        $form = $this->createForm('HVG\SystemBundle\Form\RequirementType', $requirement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($requirement);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'requirement.new.flash' );

        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Displays a form to edit an existing Requirement entity.
     *
     */
    public function editAction(Request $request, Requirement $requirement)
    {
        $deleteForm = $this->createDeleteForm($requirement);
        $editForm = $this->createForm('HVG\SystemBundle\Form\RequirementType', $requirement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($requirement);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'requirement.edit.flash' );

        }

        return $this->redirect($request->headers->get('referer'));

    }

    /**
     * Deletes a Requirement entity.
     *
     */
    public function deleteAction(Request $request, Requirement $requirement)
    {
        $form = $this->createDeleteForm($requirement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($requirement);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'requirement.delete.flash' );
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a Requirement entity.
     *
     * @param Requirement $requirement The Requirement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Requirement $requirement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('requirement_delete', array('id' => $requirement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Creates a form to delete a Requirement entity.
     *
     * @param Requirement $requirement The Requirement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteCommentForm(RequirementComment $requirementComment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('requirement_comment_delete', array('id' => $requirementComment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
