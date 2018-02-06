<?php

namespace HVG\ExchangeBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function subMenu(FactoryInterface $factory, array $options)
    {
        $submenu = $factory->createItem('root');
        $submenu->setChildrenAttribute('class', 'nav nav-pills');
        $submenu->setChildrenAttribute('id', 'sub-menu');

        $submenu->addChild('dashboard.index.link', array('route' => 'hvg_exchange_homepage'))->setExtras(array('translation_domain' => 'HVGExchangeBundle', 'routes' => array(array( 'route' => 'hvg_exchange_homepage'))));
        $submenu->addChild('ticket.index.link', array('route' => 'exchange_ticket_index'))->setExtras(array('translation_domain' => 'HVGExchangeBundle', 'routes' => array(array( 'route' => 'exchange_ticket_index'))));
        $submenu->addChild('ticketliability.index.link', array('route' => 'exchange_ticketliability_index'))->setExtras(array('translation_domain' => 'HVGExchangeBundle', 'routes' => array(array( 'route' => 'exchange_ticketliability_index'))));
        $submenu->addChild('ticketzone.index.link', array('route' => 'exchange_ticketzone_index'))->setExtras(array('translation_domain' => 'HVGExchangeBundle', 'routes' => array(array( 'route' => 'exchange_ticketzone_index'))));

        return $submenu;
    }

    public function sideMenu(FactoryInterface $factory, array $options)
    {
        $sidemenu = $factory->createItem('root');
        $sidemenu->setChildrenAttribute('class', 'nav nav-pills nav-stacked');
        $sidemenu->setChildrenAttribute('id', 'side-menu');

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