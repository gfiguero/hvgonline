<?php

namespace HVG\AccessControlBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MonitorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('monitor', null, array(
                'label' => false,
                'attr' => array(
                    'input_group' => array(
                        'button_append' => array('name' => 'Buscar', 'type' => 'submit')
                    )
                )
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hvg_accesscontrolbundle_monitor';
    }


}
