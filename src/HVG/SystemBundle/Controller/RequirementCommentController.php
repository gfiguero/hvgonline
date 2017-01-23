<?php

namespace HVG\SystemBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HVG\SystemBundle\Entity\Requirement;
use HVG\SystemBundle\Form\RequirementType;

use HVG\SystemBundle\Entity\RequirementComment;
use HVG\SystemBundle\Form\RequirementCommentType;

class RequirementCommentController extends Controller
{
    /**
     * Creates a new RequirementComment entity.
     *
     */
    public function newAction(Request $request, Requirement $requirement)
    {
        $requirementComment = new RequirementComment();
        $form = $this->createForm('HVG\SystemBundle\Form\RequirementCommentType', $requirementComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $requirementComment->setRequirement($requirement);
            $em = $this->getDoctrine()->getManager();
            $em->persist($requirementComment);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'requirement.comment.new.flash' );

        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Displays a form to edit an existing RequirementComment entity.
     *
     */
    public function editAction(Request $request, RequirementComment $requirementComment)
    {
        $deleteForm = $this->createDeleteForm($requirementComment);
        $editForm = $this->createForm('HVG\SystemBundle\Form\RequirementCommentType', $requirementComment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($requirementComment);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'success', 'requirement.comment.edit.flash' );

            return $this->redirect($request->headers->get('referer'));
        }

        return $this->render('requirementComment/edit.html.twig', array(
            'requirementComment' => $requirementComment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a RequirementComment entity.
     *
     */
    public function deleteAction(Request $request, RequirementComment $requirementComment)
    {
        $form = $this->createDeleteForm($requirementComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($requirementComment);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'requirement.comment.delete.flash' );
        }

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * Creates a form to delete a RequirementComment entity.
     *
     * @param RequirementComment $requirementComment The RequirementComment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RequirementComment $requirementComment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('requirement_comment_delete', array('id' => $requirementComment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
