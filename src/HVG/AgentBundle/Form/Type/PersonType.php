<?php

namespace HVG\AgentBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rut', null, array(
                'label' => false,
                'translation_domain' => 'HVGAgentBundle',
                'required' => true,
                'attr' => array('class' => 'input rut', 'label_col' => 0, 'widget_col' => 12, 'placeholder' => 'person.form.rut'),
            ))
            ->add('name', null, array(
                'label' => false,
                'translation_domain' => 'HVGAgentBundle',
                'required' => true,
                'attr' => array('class' => 'input', 'label_col' => 0, 'widget_col' => 12, 'placeholder' => 'person.form.name'),
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HVG\SystemBundle\Entity\Person',
            'attr' => array('style' => 'horizontal')
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hvg_agentbundle_person';
    }


}
