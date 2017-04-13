<?php

namespace HVG\AgentBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function sideMenu(FactoryInterface $factory, array $options)
    {

        $sidemenu = $factory->createItem('root');
        $sidemenu->setChildrenAttribute('class', 'nav');
        $sidemenu->setChildrenAttribute('id', 'side-menu');

        $sidemenu->addChild('sidemenu.datacenter')->setAttribute('icon', 'list fa-fw')->setAttribute('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.datacenter']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['sidemenu.datacenter']->addChild('sidemenu.community', array('route' => 'agent_community_index'))->setAttribute('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.datacenter']->addChild('sidemenu.building', array('route' => 'agent_building_index'))->setAttribute('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.datacenter']->addChild('sidemenu.unit', array('route' => 'agent_unit_index'))->setAttribute('translation_domain', 'HVGAgentBundle');
        //$sidemenu['sidemenu.datacenter']->addChild('sidemenu.person', array('route' => 'agent_person_index'))->setAttribute('translation_domain', 'HVGAgentBundle');
        //$sidemenu['sidemenu.datacenter']->addChild('sidemenu.contact', array('route' => 'agent_contact_index'))->setAttribute('translation_domain', 'HVGAgentBundle');
        //$sidemenu['sidemenu.datacenter']->addChild('sidemenu.provider', array('route' => 'agent_provider_index'))->setAttribute('translation_domain', 'HVGAgentBundle');

        $sidemenu->addChild('sidemenu.resources')->setAttribute('icon', 'list fa-fw')->setAttribute('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.resources']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['sidemenu.resources']->addChild('sidemenu.communitystaff', array('route' => 'agent_communitystaff_index'))->setAttribute('translation_domain', 'HVGAgentBundle');

        return $sidemenu;
    }

}