<?php

namespace HVG\ExchangeBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class TicketBuilder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function sideMenu(FactoryInterface $factory, array $options)
    {
        $sidemenu = $factory->createItem('root');
        $sidemenu->setChildrenAttribute('class', 'nav nav-pills nav-stacked');
        $sidemenu->setChildrenAttribute('id', 'side-menu');

        $sidemenu->addChild('ticket.index.new', array('route' => 'exchange_ticket_index'))->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array('exchange_ticket_index')));
        $sidemenu->addChild('ticket.index.assigned', array('route' => 'exchange_ticket_index'))->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array('exchange_ticket_index')));
        $sidemenu->addChild('ticket.index.progress', array('route' => 'exchange_ticket_index'))->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array('exchange_ticket_index')));
        $sidemenu->addChild('ticket.index.pending', array('route' => 'exchange_ticket_index'))->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array('exchange_ticket_index')));
        $sidemenu->addChild('ticket.index.resolved', array('route' => 'exchange_ticket_index'))->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array('exchange_ticket_index')));
        $sidemenu->addChild('ticket.index.closed', array('route' => 'exchange_ticket_index'))->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array('exchange_ticket_index')));

        return $sidemenu;
    }

    public function tabsMenu(FactoryInterface $factory, array $options)
    {
        $request = $this->container->get('request');
        $community = $options['community'] ? $options['community']->getId() : null;
        $unitgroup = $options['unitgroup'] ? $options['unitgroup']->getId() : null;
        $unit = $options['unit'] ? $options['unit']->getId() : null;

        $tabs = $factory->createItem('root');
        $tabs->setChildrenAttribute('class', 'nav nav-pills');
        $tabs->setChildrenAttribute('id', 'tabs-menu');

        return $tabs;
    }

}