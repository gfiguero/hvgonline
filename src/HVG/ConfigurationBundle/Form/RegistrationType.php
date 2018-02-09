<?php

namespace HVG\ConfigurationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', array(
                'label' => 'user.form.email',
                'translation_domain' => 'HVGConfigurationBundle',
                'attr' => array( 'label_col' => 4, 'widget_col' => 8 ),
            ))
            ->add('username', null, array(
                'label' => 'user.form.username',
                'translation_domain' => 'HVGConfigurationBundle',
                'attr' => array( 'label_col' => 4, 'widget_col' => 8 ),
            ))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'HVGConfigurationBundle'),
                'first_options' => array(
                    'label' => 'user.form.password',
                    'attr' => array( 'label_col' => 4, 'widget_col' => 8 ),
                ),
                'second_options' => array(
                    'label' => 'user.form.password_confirmation',
                    'attr' => array( 'label_col' => 4, 'widget_col' => 8 ),
                ),
                'invalid_message' => 'user.password.mismatch',
                'attr' => array( 'label_col' => 4, 'widget_col' => 8 ),
            ))
            ->add('person', null, array(
                'label' => 'user.form.person',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGConfigurationBundle',
            ))
            ->add('zones', null, array(
                'label' => 'user.form.zones',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGConfigurationBundle',
                'multiple' => true,
                'expanded' => true,
            ))
        ;
    }
    
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
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
        return 'hvg_configurationbundle_registration';
    }


}
