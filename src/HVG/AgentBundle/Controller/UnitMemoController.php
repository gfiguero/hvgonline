<?php

namespace HVG\AgentBundle\Controller;

use HVG\SystemBundle\Entity\Community;
use HVG\SystemBundle\Entity\UnitGroup;
use HVG\SystemBundle\Entity\Unit;
use HVG\SystemBundle\Entity\UnitMemo;
use HVG\AgentBundle\Form\UnitMemoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Unitmemo controller.
 *
 */
class UnitMemoController extends Controller
{

    /**
     * Lists all UnitMemo entities.
     *
     */
    public function indexAction(Request $request, Community $community = null, UnitGroup $unitgroup = null, Unit $unit = null)
    {
        $em = $this->getDoctrine()->getManager();
        $communities = $em->getRepository('HVGSystemBundle:Community')->findAll();
        $unitgroups = $em->getRepository('HVGSystemBundle:UnitGroup')->findByCommunity($community);
        $units = $em->getRepository('HVGSystemBundle:Unit')->findByUnitgroup($unitgroup);
        $unitmemos = $em->getRepository('HVGSystemBundle:UnitMemo')->findByUnit($unit);

        return $this->render('HVGAgentBundle:UnitMemo:index.html.twig', array(
            'unitmemos' => $unitmemos,
            'communities' => $communities,
            'unitgroups' => $unitgroups,
            'units' => $units,
            'currentCommunity' => $community,
            'currentUnitgroup' => $unitgroup,
            'currentUnit' => $unit,
        ));
    }

    /**
     * Creates a new UnitMemo entity.
     *
     */
    public function newAction(Request $request, Unit $unit)
    {
        $unitMemo = new UnitMemo();
        $unitMemo->setExpiredAt(new \DateTime('+30 days'));
        $newForm = $this->createNewForm($unitMemo, $unit);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $unitMemo->setUnit($unit);
                $em = $this->getDoctrine()->getManager();
                $em->persist($unitMemo);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'unitMemo.flash.created' );
                return $this->redirect($this->generateUrl('agent_unitmemo_index', array('community' => $unit->getCommunity()->getId(), 'unitgroup' => $unit->getUnitGroup()->getId(), 'unit' => $unit->getId())));
            }
        }

        return $this->render('HVGAgentBundle:UnitMemo:new.html.twig', array(
            'unit' => $unit,
            'unitMemo' => $unitMemo,
            'newForm' => $newForm->createView(),
        ));

    }

    /**
     * Creates a form to create a new UnitMemo entity.
     *
     * @param UnitMemo $unitMemo The UnitMemo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(UnitMemo $unitMemo, Unit $unit)
    {
        return $this->createForm('HVG\AgentBundle\Form\UnitMemoType', $unitMemo, array(
            'action' => $this->generateUrl('agent_unitmemo_new', array('community' => $unit->getCommunity()->getId(), 'unitgroup' => $unit->getUnitGroup()->getId(), 'unit' => $unit->getId())),
        ));
    }

    /**
     * Finds and displays a UnitMemo entity.
     *
     */
    public function showAction(UnitMemo $unitMemo)
    {
        $editForm = $this->createEditForm($unitMemo);
        $deleteForm = $this->createDeleteForm($unitMemo);

        return $this->render('unitlog/show.html.twig', array(
            'unitMemo' => $unitMemo,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing UnitMemo entity.
     *
     */
    public function editAction(Request $request, UnitMemo $unitMemo)
    {
        $editForm = $this->createEditForm($unitMemo);
        $deleteForm = $this->createDeleteForm($unitMemo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($unitMemo);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'unitMemo.flash.updated' );
            } else {
                return $this->render('unitlog/edit.html.twig', array(
                    'unitMemo' => $unitMemo,
                    'editForm' => $editForm->createView(),
                    'deleteForm' => $deleteForm->createView(),
                ));
            }
        }

        return $this->redirect($this->generateUrl('unitlog_index'));
    }

    /**
     * Creates a form to edit a UnitMemo entity.
     *
     * @param UnitMemo $unitMemo The UnitMemo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(UnitMemo $unitMemo)
    {
        return $this->createForm('HVG\SystemBundle\Form\UnitMemoType', $unitMemo, array(
            'action' => $this->generateUrl('unitlog_edit', array('id' => $unitMemo->getId())),
        ));
    }

    /**
     * Deletes a UnitMemo entity.
     *
     */
    public function deleteAction(Request $request, UnitMemo $unitMemo)
    {
        $deleteForm = $this->createDeleteForm($unitMemo);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($unitMemo);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'unitMemo.flash.deleted' );
        }

        return $this->redirect($this->generateUrl('unitlog_index'));
    }

    /**
     * Creates a form to delete a UnitMemo entity.
     *
     * @param UnitMemo $unitMemo The UnitMemo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UnitMemo $unitMemo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('unitlog_delete', array('id' => $unitMemo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
