<?php

namespace HVG\SystemBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use \DateTime;

class RequirementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('community', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'requirement.form.community',
                'translation_domain' => 'HVGSystemBundle',
                'class' => 'HVGSystemBundle:Community',
                'choice_label' => 'name',
            ))
            ->add('issue', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'requirement.form.issue',
                'translation_domain' => 'HVGSystemBundle',
            ))
            ->add('committal', 'date', array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'requirement.form.committal',
                'translation_domain' => 'HVGSystemBundle',
            ))
            ->add('status', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'requirement.form.status',
                'translation_domain' => 'HVGSystemBundle',
                'class' => 'HVGSystemBundle:RequirementStatus',
                'choice_label' => 'name', 
            ))
            ->add('channel', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'requirement.form.channel',
                'translation_domain' => 'HVGSystemBundle',
                'class' => 'HVGSystemBundle:CommunicationChannel',
                'choice_label' => 'name',
            ))
            ->add('creator', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'requirement.form.creator',
                'translation_domain' => 'HVGSystemBundle',
                'class' => 'HVGSystemBundle:Agent',
                'choice_label' => 'fullname',
            ))
            ->add('carrier', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'requirement.form.carrier',
                'translation_domain' => 'HVGSystemBundle',
                'class' => 'HVGSystemBundle:Agent',
                'choice_label' => 'fullname',
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HVG\SystemBundle\Entity\Requirement'
        ));
    }
}
