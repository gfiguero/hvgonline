<?php

namespace Unisystem\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Util\LegacyFormHelper;

class ResettingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
                'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => false, 'attr' => array( 'class' => 'text-center', 'placeholder' => 'form.new_password' )),
                'second_options' => array('label' => false, 'attr' => array( 'class' => 'text-center', 'placeholder' => 'form.new_password_confirmation' )),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
        ;

    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ResettingFormType';
    }

    public function getBlockPrefix()
    {
        return 'unisystem_user_resetting';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}