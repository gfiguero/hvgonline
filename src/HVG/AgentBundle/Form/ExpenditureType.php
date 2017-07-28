<?php

namespace HVG\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExpenditureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('community', null, array(
                'label' => 'expenditure.form.community',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
                'placeholder' => 'expenditure.form.placeholder.community',
            ))
            ->add('description', null, array(
                'label' => 'expenditure.form.description',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
            ))
            ->add('items', 'bootstrap_collection', array(
                'entry_type' => 'HVG\AgentBundle\Form\ItemType',
                'label' => 'expenditure.form.items',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
                'allow_add' => true,
                'allow_delete' => true,
                'sub_widget_col' => 9,
                'button_col' => 3,
                'delete_button_text' => 'expenditure.form.deleteitem',
                'add_button_text' => 'expenditure.form.additem',
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
            'data_class' => 'HVG\SystemBundle\Entity\Expenditure'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hvg_agentbundle_expenditure';
    }


}
