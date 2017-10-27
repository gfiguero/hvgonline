<?php

namespace HVG\AccessControlBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function topMenu(FactoryInterface $factory, array $options)
    {

        $request = $this->container->get('request');
        $hash = $request->attributes->get('hash');
        $accessguard = $request->attributes->get('accessguard');
        $checkpoint = $request->attributes->get('checkpoint');

        $topmenu = $factory->createItem('root');
        $topmenu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');
        $topmenu->setChildrenAttribute('id', 'top-menu');
/*
        $topmenu->addChild('topmenu.guest.new', array('route' => 'accesscontrol_guest_new', 'routeParameters' => array('hash' => $hash)))->setExtras(array('translation_domain' => 'HVGAccessControlBundle', 'routes' => array(
            array('route' => 'accesscontrol_guest_new', 'parameters' => array('hash' => $hash)),
        )));
        $topmenu->addChild('topmenu.guest.index', array('route' => 'accesscontrol_guest_index', 'routeParameters' => array('hash' => $hash)))->setExtras(array('translation_domain' => 'HVGAccessControlBundle', 'routes' => array(
            'accesscontrol_guest_index',
        )));
*/
        if ($checkpoint and $accessguard) {
            $topmenu->addChild('topmenu.checkpoint', array('route' => 'accesscontrol_checkpoint_change', 'routeParameters' => array(
                'hash' => $hash,
                'accessguard' => $accessguard->getId(),
                'checkpoint' => $checkpoint->getId(),
            )))->setLabel($checkpoint->getName());

            $topmenu->addChild('topmenu.accessguard', array('route' => 'accesscontrol_accessguard_change', 'routeParameters' => array(
                'hash' => $hash,
                'accessguard' => $accessguard->getId(),
                'checkpoint' => $checkpoint->getId(),
            )))->setLabel($accessguard->getName());
        }

        return $topmenu;
    }

}