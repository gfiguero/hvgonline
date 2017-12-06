<?php

namespace HVG\ExchangeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TicketStatusType extends AbstractType
{
    private $ticketstatuses;

    public function __construct(array $ticketstatuses)
    {
        $this->ticketstatuses = $ticketstatuses;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array_flip($this->ticketstatuses),
            'choices_as_values' => true,
        ));
    }

    public function getParent()
    {
        return ChoiceType::class;
    }

    public function getName()
    {
        return 'ticket_status';
    }

}