<?php

namespace HVG\PublicBundle\Menu;

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

        $topmenu = $factory->createItem('root');
        $topmenu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');
        $topmenu->setChildrenAttribute('id', 'top-menu');

        $topmenu->addChild('topmenu.ticket', array('route' => 'public_ticket_new', 'routeParameters' => array(
            'hash' => $hash,
        )))->setLabel('ticket.index.title')->setExtras(array('translation_domain' => 'HVGPublicBundle'));

        $topmenu->addChild('topmenu.pet', array('route' => 'public_pet_new', 'routeParameters' => array(
            'hash' => $hash,
        )))->setLabel('pet.index.title')->setExtras(array('translation_domain' => 'HVGPublicBundle'));

//        $topmenu->addChild('topmenu.home', array('route' => 'public_accesspermission_new', 'routeParameters' => array(
//            'hash' => $hash,
//        )))->setLabel('accesspermission.index.title')->setExtras(array('translation_domain' => 'HVGPublicBundle'));

        $topmenu->addChild('topmenu.unitinsurancepolicy', array('route' => 'public_unitinsurancepolicy_new', 'routeParameters' => array(
            'hash' => $hash,
        )))->setLabel('unitinsurancepolicy.index.title')->setExtras(array('translation_domain' => 'HVGPublicBundle'));

        return $topmenu;
    }

}