<?php

namespace HVG\AgentBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use HVG\AgentBundle\Form\Type\EntityTableType;
use Doctrine\ORM\EntityRepository;

class AddExpenditureFieldSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT   => 'preSubmit'
        );
    }

    private function addExpendituresForm($form, $community = null, $expenditures = null)
    {
        $form
            ->add('expenditures', new EntityTableType(), array(
                'class' => 'HVGSystemBundle:Expenditure',
                'label' => 'outflow.form.expenditures',
                'attr' => array( 'label_col' => 4, 'widget_col' => 8 ),
                'choice_label' => 'info',
                'translation_domain' => 'HVGAgentBundle',
                'by_reference' => false,
                'multiple' => true,
                'expanded' => true,
                'query_builder' => function(EntityRepository $er ) use ($community, $expenditures) {
                    return $er->createQueryBuilder('e')
                        ->where('e.community = :community')
                        ->andWhere('e.outflow is NULL')
                        ->orWhere('e.id in (:expenditures)')
                        ->setParameters(array('community' => $community, 'expenditures' => $expenditures))
                    ;
                },
            ))
        ;
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
        $community = $data->getCommunity();
        $expenditures = $data->getExpenditures();
        $this->addExpendituresForm($form, $community, $expenditures);
    }

    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
        $community  = array_key_exists('community', $data) ? $data['community'] : array();
        $expenditures  = array_key_exists('expenditures', $data) ? $data['expenditures'] : array();
        $this->addExpendituresForm($form, $community, $expenditures);
    }
}