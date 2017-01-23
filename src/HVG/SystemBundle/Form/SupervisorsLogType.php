<?php

namespace HVG\SystemBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use \DateTime;

class SupervisorsLogType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('supervisor', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'supervisorsLog.form.supervisor.shortname',
                'translation_domain' => 'HVGSystemBundle',
                'class' => 'HVGSystemBundle:Agent',
                'choice_label' => 'fullname',
            ))
            ->add('news', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'supervisorsLog.form.news',
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
            'data_class' => 'HVG\SystemBundle\Entity\SupervisorsLog'
        ));
    }
}
