<?php

namespace HVG\PublicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use HVG\PublicBundle\Form\Type\PersonType;
use HVG\PublicBundle\Form\Type\PetGroupType;
use HVG\PublicBundle\Form\Type\PetColorType;
use HVG\PublicBundle\Form\Type\PetGenderType;

use Symfony\Component\Form\Extension\Core\Type\EmailType;

class PetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $community = $options['community'];
        $builder
            ->add('unit', null, array(
                'label' => 'pet.form.unit',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg' ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
                'placeholder' => 'Seleccione Unidad',
                'choices' => $community->getUnits(),
            ))
            ->add('owner', PersonType::class, array(
                'label' => 'pet.form.owner',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
            ))
            ->add('phone', null, array(
                'label' => 'pet.form.phone',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg' ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
            ))
            ->add('email', EmailType::class, array(
                'label' => 'pet.form.email',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg' ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
            ))
            ->add('name', null, array(
                'label' => 'pet.form.name',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg' ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
            ))
            ->add('petgroup', PetGroupType::class, array(
                'label' => 'pet.form.petgroup',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg' ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
                'placeholder' => 'Seleccione Grupo',
            ))
            ->add('gender', PetGenderType::class, array(
                'label' => 'pet.form.gender',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg' ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
                'placeholder' => 'Seleccione Género',
            ))
            ->add('color', PetColorType::class, array(
                'label' => 'pet.form.color',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg' ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
                'placeholder' => 'Seleccione Color',
            ))
            ->add('weight', null, array(
                'label' => 'pet.form.weight',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg', 'placeholder' => 'pet.form.placeholder.weight'),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
            ))
            ->add('race', null, array(
                'label' => 'pet.form.race',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg' ),
                'translation_domain' => 'HVGPublicBundle',
            ))
            ->add('rfid', null, array(
                'label' => 'pet.form.rfid',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg', 'placeholder' => 'pet.form.placeholder.rfid'),
                'translation_domain' => 'HVGPublicBundle',
                'required' => false,
            ))
            ->add('photographyfile', 'file', array(
                'label' => 'pet.form.photography',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'data-msg-placeholder' => 'Archivo de imagen'),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
            ))
            ->add('terms', null, array(
                'label' => 'pet.form.terms',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'align_with_widget' => true ),
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
            'data_class' => 'HVG\SystemBundle\Entity\Pet',
            'community' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hvg_publicbundle_pet';
    }
}