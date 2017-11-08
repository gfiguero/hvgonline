<?php

namespace HVG\PublicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UnitInsurancePolicyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $community = $options['community'];
        $builder
            ->add('unit', null, array(
                'label' => 'unitinsurancepolicy.form.unit',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg' ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
                'placeholder' => 'Seleccione Unidad',
                'choices' => $community->getUnits(),
            ))
            ->add('file', 'fileinput', array(
                'label' => 'unitinsurancepolicy.form.filename',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg' ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
            ))
            ->add('expiredAt', null, array(
                'label' => 'unitinsurancepolicy.form.expiredAt',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg' ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
                'placeholder' => array( 
                    'year' => 'unitinsurancepolicy.form.year',
                    'month' => 'unitinsurancepolicy.form.month',
                    'day' => 'unitinsurancepolicy.form.day',
                ),
            ))
            ->add('contactname', null, array(
                'label' => 'unitinsurancepolicy.form.contactname',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg' ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
            ))
            ->add('contactemail', null, array(
                'label' => 'unitinsurancepolicy.form.contactemail',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg' ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HVG\SystemBundle\Entity\UnitInsurancePolicy',
            'community' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hvg_publicbundle_unitinsurancepolicy';
    }


}
