<?php

namespace HVG\PublicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use HVG\PublicBundle\Form\Type\PersonType;

class AccessPermissionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $community = $options['community'];
        $builder
            ->add('unit', null, array(
                'label' => 'accesspermission.form.unit',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg' ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
                'placeholder' => 'Seleccione Unidad',
                'choices' => $community->getUnits(),
            ))
            ->add('visitant', PersonType::class, array(
                'label' => 'accesspermission.form.visitant',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
            ))
            ->add('description', null, array(
                'label' => 'accesspermission.form.description',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg' ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
            ))
            ->add('applicant', PersonType::class, array(
                'label' => 'accesspermission.form.applicant',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
            ))
            ->add('cardfront', 'file', array(
                'label' => 'accesspermission.form.cardfront',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg' ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
            ))
            ->add('cardback', 'file', array(
                'label' => 'accesspermission.form.cardback',
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
            'data_class' => 'HVG\SystemBundle\Entity\AccessPermission',
            'community' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hvg_publicbundle_accesspermission';
    }
}