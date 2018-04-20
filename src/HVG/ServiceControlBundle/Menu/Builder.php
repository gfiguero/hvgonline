<?php

namespace HVG\ServiceControlBundle\Menu;

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
        $serviceagent = $request->attributes->get('serviceagent');
        $service = $request->attributes->get('service');

        $topmenu = $factory->createItem('root');
        $topmenu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');
        $topmenu->setChildrenAttribute('id', 'top-menu');

        if ($service and $serviceagent) {
            $topmenu->addChild('topmenu.service', array('route' => 'servicecontrol_service_change', 'routeParameters' => array(
                'hash' => $hash,
                'serviceagent' => $serviceagent->getId(),
                'service' => $service->getId(),
            )))->setLabel($service->getName());

            $topmenu->addChild('topmenu.serviceagent', array('route' => 'servicecontrol_serviceagent_change', 'routeParameters' => array(
                'hash' => $hash,
                'serviceagent' => $serviceagent->getId(),
                'service' => $service->getId(),
            )))->setLabel($serviceagent->getName());
        }

        return $topmenu;
    }

}