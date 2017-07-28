<?php

namespace HVG\AgentBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntityTableType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'entitytable';
    }

    public function getParent()
    {
        return 'entity';
    }

}
