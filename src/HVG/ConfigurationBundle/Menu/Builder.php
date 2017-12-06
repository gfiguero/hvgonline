<?php

namespace HVG\ConfigurationBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function sideMenu(FactoryInterface $factory, array $options)
    {
        $sidemenu = $factory->createItem('root');
        $sidemenu->setChildrenAttribute('class', 'nav nav-pills nav-stacked');
        $sidemenu->setChildrenAttribute('id', 'side-menu');

        $sidemenu->addChild('sidemenu.root.zone', array('route' => 'configuration_zone_index'))->setExtras(array('translation_domain' => 'HVGConfigurationBundle', 'routes' => array(
            array('route' => 'configuration_zone_index'),
            array('route' => 'configuration_zone_new'),
            array('route' => 'configuration_zone_edit'),
            array('route' => 'configuration_zone_show'),
            array('route' => 'configuration_zone_delete'),
        )));

        $sidemenu->addChild('sidemenu.root.user', array('route' => 'configuration_user_index'))->setExtras(array('translation_domain' => 'HVGConfigurationBundle', 'routes' => array(
            array('route' => 'configuration_user_index'),
            array('route' => 'configuration_user_new'),
            array('route' => 'configuration_user_edit'),
            array('route' => 'configuration_user_show'),
            array('route' => 'configuration_user_delete'),
        )));

        return $sidemenu;
    }

}