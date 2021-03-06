<?php

namespace HVG\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RoleType extends AbstractType
{
    private $roleChoices;

    public function __construct(array $roleChoices)
    {
        $this->roleChoices = $roleChoices;
    }

    public function getParent()
    {
        return new ChoiceType();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => $this->roleChoices,
        ));
    }

}