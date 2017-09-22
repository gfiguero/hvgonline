<?php

namespace HVG\AccessControlBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function sideMenu(FactoryInterface $factory, array $options)
    {

        $request = $this->container->get('request');
        $hash = $request->attributes->get('hash');

        $sidemenu = $factory->createItem('root');
        $sidemenu->setChildrenAttribute('class', 'nav');
        $sidemenu->setChildrenAttribute('id', 'aside-menu');

        $sidemenu->addChild('sidemenu.guest.new', array('route' => 'accesscontrol_guest_new', 'routeParameters' => array('hash' => $hash)))->setAttributes(array('translation_domain' => 'HVGAccessControlBundle', 'routes' => array(
            'accesscontrol_guest_new',
        )));
        $sidemenu->addChild('sidemenu.guest.index', array('route' => 'accesscontrol_guest_index', 'routeParameters' => array('hash' => $hash)))->setAttributes(array('translation_domain' => 'HVGAccessControlBundle', 'routes' => array(
            'accesscontrol_guest_index',
        )));

        return $sidemenu;
    }

}