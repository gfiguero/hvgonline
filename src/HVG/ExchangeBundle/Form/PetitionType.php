<?php

namespace HVG\ExchangeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PetitionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', null, array(
                'label' => 'petition.form.description',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGExchangeBundle',
            ))
            ->add('expiry', null, array(
                'label' => 'petition.form.expiry',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGExchangeBundle',
            ))
            ->add('petitionobjectives', 'bootstrap_collection', array(
                'entry_type' => 'HVG\ExchangeBundle\Form\PetitionObjectiveType',
                'label' => 'petition.form.petitionobjectives',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGExchangeBundle',
                'allow_add' => true,
                'allow_delete' => true,
                'sub_widget_col' => 9,
                'button_col' => 3,
                'delete_button_text' => 'petition.form.deleteobjective',
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
        return 'hvg_exchangebundle_petition';
    }


}
