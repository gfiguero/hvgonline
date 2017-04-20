<?php

namespace HVG\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('person', null, array(
                'label' => 'user.form.person',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGUserBundle',
            ))
            ->add('areas', null, array(
                'label' => 'user.form.areas',
                'expanded' => true,
                'multiple' => true,
                'translation_domain' => 'HVGUserBundle',
                'attr' => array( 'label_col' => 4, 'widget_col' => 8 ),
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HVG\UserBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hvg_userbundle_user';
    }


}
