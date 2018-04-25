<?php

namespace HVG\PublicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $community = $options['community'];
        $builder
            ->add('unit', null, array(
                'label' => 'ticket.form.unit',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg' ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
                'placeholder' => 'ticket.form.placeholder.unit',
                'choices' => $community->getUnits(),
            ))
            ->add('zone', null, array(
                'label' => 'ticket.form.zone',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg' ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
                'placeholder' => 'ticket.form.placeholder.zone',
                'choices' => $community->getZones(),
                'choice_label' => 'name',
            ))
            ->add('description', null, array(
                'label' => 'ticket.form.description',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg' ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
            ))
            ->add('contactname', null, array(
                'label' => 'ticket.form.contactname',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg' ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
            ))
            ->add('contactphone', null, array(
                'label' => 'ticket.form.contactphone',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg' ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
            ))
            ->add('contactemail', null, array(
                'label' => 'ticket.form.contactemail',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'input input-lg' ),
                'translation_domain' => 'HVGPublicBundle',
                'required' => true,
            ))
            ->add('file', 'file', array(
                'label' => 'ticket.form.file',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'data-msg-placeholder' => 'Archivo'),
                'translation_domain' => 'HVGPublicBundle',
                'required' => false,
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HVG\SystemBundle\Entity\Ticket',
            'community' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hvg_publicbundle_ticket';
    }
}