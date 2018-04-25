<?php

namespace HVG\ExchangeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use HVG\ExchangeBundle\Form\Type\TicketStatusType;

class TicketType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $community = $options['unit']->getCommunity();
        $builder
            ->add('description', null, array(
                'label' => 'ticket.form.description',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGExchangeBundle',
            ))
            ->add('contactname', null, array(
                'label' => 'ticket.form.contactname',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGExchangeBundle',
            ))
            ->add('contactphone', null, array(
                'label' => 'ticket.form.contactphone',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGExchangeBundle',
            ))
            ->add('contactemail', null, array(
                'label' => 'ticket.form.contactemail',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGExchangeBundle',
            ))
            ->add('zone', null, array(
                'label' => 'ticket.form.zone',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGExchangeBundle',
                'required' => true,
                'placeholder' => 'Seleccione Zona',
                'choices' => $community->getZones(),
                'choice_label' => 'name',
            ))
            ->add('file', 'file', array(
                'label' => 'ticket.form.file',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'data-msg-placeholder' => 'Archivo'),
                'translation_domain' => 'HVGExchangeBundle',
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
            'unit' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hvg_exchangebundle_ticket';
    }


}
