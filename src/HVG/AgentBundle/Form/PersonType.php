<?php

namespace HVG\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('name', null, array(
                'label' => 'person.form.name',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
            )) 
            ->add('rut', null, array(
                'required' => false,
                'label' => 'person.form.rut',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'rut'),
                'translation_domain' => 'HVGAgentBundle',
            ))
            ->add('contacts', 'bootstrap_collection', array(
                'entry_type' => 'HVG\AgentBundle\Form\ContactType',
                'label' => 'person.form.contacts',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
                'allow_add' => true,
                'allow_delete' => true,
                'add_button_text' => 'person.form.addcontact',
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
            'data_class' => 'HVG\SystemBundle\Entity\Person'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hvg_agentbundle_person';
    }


}
