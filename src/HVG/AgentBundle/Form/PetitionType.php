<?php

namespace HVG\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use HVG\AgentBundle\Form\HiddenUnit;

class PetitionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('community', null, array(
                'label' => 'petition.form.community',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
            ))
            ->add('area', null, array(
                'label' => 'petition.form.area',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
            ))
            ->add('liability', null, array(
                'choice_label' => 'person',
                'label' => 'petition.form.liability',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
            ))
            ->add('description', null, array(
                'label' => 'petition.form.description',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
            ))
            ->add('expiry', null, array(
                'data' => new \DateTime('+2 days'),
                'label' => 'petition.form.expiry',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
            ))
            ->add('petitionobjectives', 'bootstrap_collection', array(
                'entry_type' => 'HVG\AgentBundle\Form\PetitionObjectiveType',
                'label' => 'petition.form.petitionobjectives',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
                'allow_add' => true,
                'add_button_text' => 'petition.form.addobjective',
                'by_reference' => false,
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HVG\SystemBundle\Entity\Petition'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hvg_agentbundle_petition';
    }


}
