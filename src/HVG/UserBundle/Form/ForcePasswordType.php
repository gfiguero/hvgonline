<?php

namespace HVG\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ForcePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('plainPassword', 'Symfony\Component\Form\Extension\Core\Type\RepeatedType', array(
            'type' => 'Symfony\Component\Form\Extension\Core\Type\PasswordType',
            'options' => array('translation_domain' => 'HVGUserBundle'),
            'first_options' => array('label' => 'user.form.new_password'),
            'second_options' => array('label' => 'user.form.new_password_confirmation'),
            'invalid_message' => 'fos_user.password.mismatch',
            'attr' => array( 'label_col' => 4, 'widget_col' => 8 ),
        ));
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }

    public function getBlockPrefix()
    {
        return 'unisystem_user_change_password';
    }
}
