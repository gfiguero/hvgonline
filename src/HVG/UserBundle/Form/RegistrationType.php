<?php

namespace HVG\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', array(
                'label' => 'user.form.email',
                'translation_domain' => 'HVGUserBundle',
                'attr' => array( 'label_col' => 4, 'widget_col' => 8 ),
            ))
            ->add('username', null, array(
                'label' => 'user.form.username',
                'translation_domain' => 'HVGUserBundle',
                'attr' => array( 'label_col' => 4, 'widget_col' => 8 ),
            ))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'HVGUserBundle'),
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
                'translation_domain' => 'HVGUserBundle',
                'attr' => array( 'label_col' => 4, 'widget_col' => 8 ),
            ))
            ->add('areas', null, array(
                'label' => 'user.form.areas',
                'expanded' => true,
                'multiple' => true,
                'translation_domain' => 'HVGUserBundle',
                'attr' => array( 'label_col' => 4, 'widget_col' => 8 ),
            ))
            ->add('communities', null, array(
                'label' => 'user.form.communities',
                'expanded' => true,
                'multiple' => true,
                'translation_domain' => 'HVGUserBundle',
                'attr' => array( 'label_col' => 4, 'widget_col' => 8 ),
            ))
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'hvg_user_registration';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}