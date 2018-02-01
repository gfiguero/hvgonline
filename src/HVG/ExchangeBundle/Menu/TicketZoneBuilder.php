<?php

namespace HVG\ExchangeBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class TicketZoneBuilder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function sideMenu(FactoryInterface $factory, array $options)
    {
        $sidemenu = $factory->createItem('root');
        $sidemenu->setChildrenAttribute('class', 'nav nav-pills nav-stacked');
        $sidemenu->setChildrenAttribute('id', 'side-menu');

        $sidemenu->addChild('ticket.statusmenu.all', array('route' => 'exchange_ticketzone_index', 'routeParameters' => array('status' => 0)))->setExtras(array('translation_domain' => 'HVGExchangeBundle', 'routes' => array(array( 'route' => 'exchange_ticketzone_index', 'parameters' => array('status' => 0)))));
        $sidemenu->addChild('ticket.statusmenu.new', array('route' => 'exchange_ticketzone_index', 'routeParameters' => array('status' => 1)))->setExtras(array('translation_domain' => 'HVGExchangeBundle', 'routes' => array(array( 'route' => 'exchange_ticketzone_index', 'parameters' => array('status' => 1)))));
        $sidemenu->addChild('ticket.statusmenu.assigned', array('route' => 'exchange_ticketzone_index', 'routeParameters' => array('status' => 2)))->setExtras(array('translation_domain' => 'HVGExchangeBundle', 'routes' => array(array( 'route' => 'exchange_ticketzone_index', 'parameters' => array('status' => 2)))));
        $sidemenu->addChild('ticket.statusmenu.progress', array('route' => 'exchange_ticketzone_index', 'routeParameters' => array('status' => 3)))->setExtras(array('translation_domain' => 'HVGExchangeBundle', 'routes' => array(array( 'route' => 'exchange_ticketzone_index', 'parameters' => array('status' => 3)))));
        $sidemenu->addChild('ticket.statusmenu.pending', array('route' => 'exchange_ticketzone_index', 'routeParameters' => array('status' => 4)))->setExtras(array('translation_domain' => 'HVGExchangeBundle', 'routes' => array(array( 'route' => 'exchange_ticketzone_index', 'parameters' => array('status' => 4)))));
        $sidemenu->addChild('ticket.statusmenu.resolved', array('route' => 'exchange_ticketzone_index', 'routeParameters' => array('status' => 5)))->setExtras(array('translation_domain' => 'HVGExchangeBundle', 'routes' => array(array( 'route' => 'exchange_ticketzone_index', 'parameters' => array('status' => 5)))));
        $sidemenu->addChild('ticket.statusmenu.closed', array('route' => 'exchange_ticketzone_index', 'routeParameters' => array('status' => 6)))->setExtras(array('translation_domain' => 'HVGExchangeBundle', 'routes' => array(array( 'route' => 'exchange_ticketzone_index', 'parameters' => array('status' => 6)))));

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