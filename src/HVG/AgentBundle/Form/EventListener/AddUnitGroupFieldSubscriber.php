<?php

namespace HVG\AgentBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;

class AddUnitGroupFieldSubscriber implements EventSubscriberInterface
{
    private $communities;

    public function __construct($communities = null)
    {
        $this->communities = $communities;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT   => 'preSubmit'
        );
    }

    private function addUnitGroupsForm($form)
    {
        $communities = $this->communities;
        $form
            ->add('unitgroup', 'entity', array(
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'placeholder' => 'Seleccione Grupo',
                'translation_domain' => 'HVGAgentBundle',
                'class'              => 'HVGSystemBundle:UnitGroup',
                'query_builder'      => function (EntityRepository $er) use ($communities) {
                    if ($communities) {
                        return $er->createQueryBuilder('ug')
                            ->where('ug.community IN (:communities)')
                            ->setParameter('communities', $communities)
                        ;
                    } else {
                        return $er->createQueryBuilder('ug');                    
                    }
                }
            ))
        ;
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
        $community = $data->getCommunity();
        $this->addUnitGroupsForm($form, $community);
    }

    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
        $community  = array_key_exists('community', $data) ? $data['community'] : array();
        $this->addUnitGroupsForm($form, $community);
    }
}