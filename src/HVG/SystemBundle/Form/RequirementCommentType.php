<?php

namespace HVG\SystemBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use \DateTime;

class RequirementCommentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'requirementComment.form.name',
                'translation_domain' => 'HVGSystemBundle',
            ))/*
            ->add('requirement', 'entity', array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'requirementComment.form.name',
                'translation_domain' => 'HVGSystemBundle',
                'class' => 'HVGSystemBundle:Requirement',
                'choice_label' => 'id',
            ))*/
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HVG\SystemBundle\Entity\RequirementComment'
        ));
    }
}
