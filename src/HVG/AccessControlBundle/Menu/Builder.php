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

        $sidemenu->addChild('sidemenu.guest.root', array('route' => 'accesscontrol_guest_new', 'routeParameters' => array('hash' => $hash)))->setExtras(array('translation_domain' => 'HVGAccessControlBundle', 'routes' => array(
            'offer_account_edit',
        )));


        return $sidemenu;
    }

}