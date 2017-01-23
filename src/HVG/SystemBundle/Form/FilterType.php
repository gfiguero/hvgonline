<?php

namespace HVG\SystemBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use \DateTime;

class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('community', 'entity', array(
                'class' => 'HVGSystemBundle:Community',
                'choice_label' => 'name',
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => false,
                'translation_domain' => 'HVGSystemBundle',
            ))
        ;
    }
}
