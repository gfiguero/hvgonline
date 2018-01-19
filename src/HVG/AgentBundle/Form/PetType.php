<?php

namespace HVG\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use HVG\AgentBundle\Form\Type\PersonType;
use HVG\AgentBundle\Form\Type\PetGroupType;
use HVG\AgentBundle\Form\Type\PetColorType;
use HVG\AgentBundle\Form\Type\PetGenderType;

class PetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $community = $options['community'];
        $builder
            ->add('owner', PersonType::class, array(
                'label' => 'pet.form.owner',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
                'required' => true,
            ))
            ->add('phone', null, array(
                'label' => 'pet.form.phone',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
                'required' => true,
            ))
            ->add('email', null, array(
                'label' => 'pet.form.email',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
                'required' => true,
            ))
            ->add('name', null, array(
                'label' => 'pet.form.name',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
                'required' => true,
            ))
            ->add('petgroup', PetGroupType::class, array(
                'label' => 'pet.form.petgroup',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
                'required' => true,
                'placeholder' => 'Seleccione Grupo',
            ))
            ->add('gender', PetGenderType::class, array(
                'label' => 'pet.form.gender',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
                'required' => true,
                'placeholder' => 'Seleccione Género',
            ))
            ->add('color', PetColorType::class, array(
                'label' => 'pet.form.color',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
                'required' => true,
                'placeholder' => 'Seleccione Color',
            ))
            ->add('race', null, array(
                'label' => 'pet.form.race',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
            ))
            ->add('weight', null, array(
                'label' => 'pet.form.weight',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
                'required' => true,
            ))
            ->add('photographyfile', 'file', array(
                'label' => 'pet.form.photography',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
                'required' => true,
            ))
            ->add('terms', null, array(
                'label' => 'pet.form.terms',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'align_with_widget' => true ),
                'translation_domain' => 'HVGAgentBundle',
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
        return 'hvg_agentbundle_pet';
    }
}