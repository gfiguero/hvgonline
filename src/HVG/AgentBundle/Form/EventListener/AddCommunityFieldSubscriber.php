<?php

namespace HVG\AgentBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;

class AddCommunityFieldSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData'
        );
    }

    private function addCommunityForm($form)
    {
        $form
            ->add('community', 'entity', array(
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'placeholder' => 'Seleccione Comunidad',
                'translation_domain' => 'HVGAgentBundle',
                'class'              => 'HVGSystemBundle:Community',
                'required' => true,
                'query_builder'      => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c');
                }
            ))
        ;
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
        $this->addCommunityForm($form);
    }
}