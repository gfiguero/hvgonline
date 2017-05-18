<?php

namespace HVG\AgentBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;

class AddUnitFieldSubscriber implements EventSubscriberInterface
{
    private $unitgroups;

    public function __construct($unitgroups = null)
    {
        $this->unitgroups = $unitgroups;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT   => 'preSubmit'
        );
    }

    private function addUnitsForm($form, $unitgroup = null)
    {
        $unitgroups = $this->unitgroups;
        $form
            ->add('unit', 'entity', array(
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'placeholder' => 'Seleccione Unidad',
                'translation_domain' => 'HVGAgentBundle',
                'class'              => 'HVGSystemBundle:Unit',
                'query_builder'      => function (EntityRepository $er) use ($unitgroup, $unitgroups) {
                    if($unitgroup) {
                        return $er->createQueryBuilder('u')
                            ->where('u.unitgroup = :unitgroup')
                            ->setParameter('unitgroup', $unitgroup)
                        ;
                    } elseif($unitgroups) {
                        return $er->createQueryBuilder('u')
                            ->where('u.unitgroup IN (:unitgroups)')
                            ->setParameter('unitgroups', $unitgroups)
                        ;
                    } else {
                        return $er->createQueryBuilder('u')
                        ;                        
                    }
                }
            ))
        ;
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
        $unitgroup = $data->getUnitGroup();
        $this->addUnitsForm($form, $unitgroup);
    }

    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
        $unitgroup  = array_key_exists('unitgroup', $data) ? $data['unitgroup'] : array();
        $this->addUnitsForm($form, $unitgroup);
    }
}