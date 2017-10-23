<?php

namespace HVG\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use HVG\AgentBundle\Form\EventListener\AddCommunityFieldSubscriber;
use HVG\AgentBundle\Form\EventListener\AddUnitGroupFieldSubscriber;
use HVG\AgentBundle\Form\EventListener\AddUnitFieldSubscriber;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;

class UnitFilterType extends AbstractType
{
    private $em;

    public function __construct(Doctrine $doctrine)
    {
        $this->em = $doctrine->getManager();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addEventSubscriber(new AddUnitGroupFieldSubscriber($options['communities']))
            ->addEventSubscriber(new AddUnitFieldSubscriber($options['unitgroups']))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'communities' => null,
            'unitgroups' => null,
            'units' => null,
        ));
    }

}
