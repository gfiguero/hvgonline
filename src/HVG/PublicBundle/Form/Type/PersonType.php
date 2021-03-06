<?php

namespace HVG\PublicBundle\Form\Type;

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
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
                'attr' => array('class' => 'input rut input-lg', 'label_col' => 0, 'widget_col' => 12, 'placeholder' => 'person.form.rut'),
            ))
            ->add('name', null, array(
                'label' => false,
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
                'attr' => array('class' => 'input input-lg', 'label_col' => 0, 'widget_col' => 12, 'placeholder' => 'person.form.name'),
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
        return 'hvg_publicbundle_person';
    }


}
