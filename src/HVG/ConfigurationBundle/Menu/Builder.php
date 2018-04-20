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

        $sidemenu->addChild('sidemenu.root.service', array('route' => 'configuration_service_index'))->setExtras(array('translation_domain' => 'HVGConfigurationBundle', 'routes' => array(
            array('route' => 'configuration_service_index'),
            array('route' => 'configuration_service_new'),
            array('route' => 'configuration_service_edit'),
            array('route' => 'configuration_service_show'),
            array('route' => 'configuration_service_delete'),
        )));

        $sidemenu->addChild('sidemenu.root.serviceagent', array('route' => 'configuration_serviceagent_index'))->setExtras(array('translation_domain' => 'HVGConfigurationBundle', 'routes' => array(
            array('route' => 'configuration_serviceagent_index'),
            array('route' => 'configuration_serviceagent_new'),
            array('route' => 'configuration_serviceagent_edit'),
            array('route' => 'configuration_serviceagent_show'),
            array('route' => 'configuration_serviceagent_delete'),
        )));

        $sidemenu->addChild('sidemenu.root.checkpoint', array('route' => 'configuration_checkpoint_index'))->setExtras(array('translation_domain' => 'HVGConfigurationBundle', 'routes' => array(
            array('route' => 'configuration_checkpoint_index'),
            array('route' => 'configuration_checkpoint_new'),
            array('route' => 'configuration_checkpoint_edit'),
            array('route' => 'configuration_checkpoint_show'),
            array('route' => 'configuration_checkpoint_delete'),
        )));

        $sidemenu->addChild('sidemenu.root.accessguard', array('route' => 'configuration_accessguard_index'))->setExtras(array('translation_domain' => 'HVGConfigurationBundle', 'routes' => array(
            array('route' => 'configuration_accessguard_index'),
            array('route' => 'configuration_accessguard_new'),
            array('route' => 'configuration_accessguard_edit'),
            array('route' => 'configuration_accessguard_show'),
            array('route' => 'configuration_accessguard_delete'),
        )));

        return $sidemenu;
    }

}