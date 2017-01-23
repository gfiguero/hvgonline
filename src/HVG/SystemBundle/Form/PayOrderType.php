<?php

namespace HVG\SystemBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use \DateTime;

class PayOrderType extends AbstractType
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
                'label' => 'payOrder.form.community',
                'translation_domain' => 'HVGSystemBundle',
                'class' => 'HVGSystemBundle:Community',
                'choice_label' => 'name',
            ))
            ->add('provider', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'payOrder.form.provider',
                'translation_domain' => 'HVGSystemBundle',
                'class' => 'HVGSystemBundle:Provider',
                'choice_label' => 'name',
            ))
            ->add('agent', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'payOrder.form.agent',
                'translation_domain' => 'HVGSystemBundle',
                'class' => 'HVGSystemBundle:Agent',
                'choice_label' => 'fullname',
            ))
            ->add('totalPrice', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'payOrder.form.totalPrice',
                'translation_domain' => 'HVGSystemBundle',
            ))
            ->add('description', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'payOrder.form.description',
                'translation_domain' => 'HVGSystemBundle',
            ))
            ->add('documentLink', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'payOrder.form.documentLink',
                'translation_domain' => 'HVGSystemBundle',
            ))
            ->add('finishedDate', 'date', array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'payOrder.form.finishedDate',
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
            'data_class' => 'HVG\SystemBundle\Entity\PayOrder'
        ));
    }
}
