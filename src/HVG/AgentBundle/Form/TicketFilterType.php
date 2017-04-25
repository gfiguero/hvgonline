<?php

namespace HVG\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use HVG\AgentBundle\Form\EventListener\AddCommunityFieldSubscriber;
use HVG\AgentBundle\Form\EventListener\AddUnitGroupFieldSubscriber;
use HVG\AgentBundle\Form\EventListener\AddUnitFieldSubscriber;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;

class TicketFilterType extends AbstractType
{
    private $em;

    public function __construct(Doctrine $doctrine)
    {
        $this->em = $doctrine->getManager();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->addEventSubscriber(new AddCommunityFieldSubscriber())
            ->addEventSubscriber(new AddUnitGroupFieldSubscriber())
            ->addEventSubscriber(new AddUnitFieldSubscriber())
        ;
    }
}
