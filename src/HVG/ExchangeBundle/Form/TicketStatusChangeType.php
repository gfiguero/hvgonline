<?php

namespace HVG\ExchangeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use HVG\ExchangeBundle\Form\Type\TicketStatusType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class TicketStatusChangeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', TicketStatusType::class, array(
                'label' => 'ticket.form.status',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGExchangeBundle',
            ))
            ->add('reason', TextareaType::class, array(
                'label' => 'ticket.form.reason',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGExchangeBundle',
                'mapped' => false,
            ))
            ->add('sendmail', CheckboxType::class, array(
                'label' => 'ticketaction.form.sendmail',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'align_with_widget' => true  ),
                'translation_domain' => 'HVGExchangeBundle',
                'mapped' => false,
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
            'data_class' => 'HVG\SystemBundle\Entity\Ticket'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hvg_exchangebundle_ticketstatus';
    }


}
