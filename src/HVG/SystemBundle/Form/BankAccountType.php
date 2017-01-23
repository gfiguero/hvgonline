<?php

namespace HVG\SystemBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use \DateTime;

class BankAccountType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('provider', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'requirement.form.provider',
                'translation_domain' => 'HVGSystemBundle',
                'class' => 'HVGSystemBundle:Provider',
                'choice_label' => 'name',
            ))
            ->add('bank', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'requirement.form.bank',
                'translation_domain' => 'HVGSystemBundle',
                'class' => 'HVGSystemBundle:Bank',
                'choice_label' => 'name',
            ))
            ->add('bankAccountType', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'requirement.form.bankAccountType',
                'translation_domain' => 'HVGSystemBundle',
                'class' => 'HVGSystemBundle:BankAccountType',
                'choice_label' => 'name',
            ))
            ->add('rut', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'requirement.form.rut',
                'translation_domain' => 'HVGSystemBundle',
            ))
            ->add('name', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'requirement.form.name',
                'translation_domain' => 'HVGSystemBundle',
            ))
            ->add('number', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'requirement.form.number',
                'translation_domain' => 'HVGSystemBundle',
            ))
            ->add('mail', null, array(
                'attr' => array( 'label_col' => 3, 'widget_col' => 9 ),
                'label' => 'requirement.form.mail',
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
            'data_class' => 'HVG\SystemBundle\Entity\BankAccount'
        ));
    }
}
