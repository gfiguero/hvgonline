<?php

namespace HVG\SystemBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use \DateTime;

class ProviderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'requirementProvider.form.name',
                'translation_domain' => 'HVGSystemBundle',
            ))
            ->add('rut', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'requirementProvider.form.rut',
                'translation_domain' => 'HVGSystemBundle',
            ))
            ->add('phone', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'requirementProvider.form.phone',
                'translation_domain' => 'HVGSystemBundle',
            ))
            ->add('mail', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'requirementProvider.form.mail',
                'translation_domain' => 'HVGSystemBundle',
            ))
            ->add('expert_name', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'requirementProvider.form.expert_name',
                'translation_domain' => 'HVGSystemBundle',
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HVG\SystemBundle\Entity\Provider'
        ));
    }
}
