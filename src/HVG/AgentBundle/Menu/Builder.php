<?php

namespace HVG\AgentBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function topMenu(FactoryInterface $factory, array $options)
    {
        $roles = $this->container->get('security.token_storage')->getToken()->getUser()->getRoles();

        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');
        $menu->setChildrenAttribute('id', 'top-menu');

        if(in_array('ROLE_ADMIN', $roles)) {
            $menu->addChild('topmenu.configuration.index', array('route' => 'configuration_zone_index'));
            $menu['topmenu.configuration.index']->setExtras(array('icon' => 'cogs fa-fw', 'translation_domain' => 'HVGConfigurationBundle'));
        }

        if(in_array('ROLE_AGENT', $roles)) {

/*
            $menu->addChild('topmenu.create.menu', array('uri' => '#'));
            $menu['topmenu.create.menu']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'role' => 'button', 'aria-haspopup' => 'true', 'aria-expanded' => 'false'));
            $menu['topmenu.create.menu']->setExtras(array( 'icon' => 'plus fa-fw', 'dropdown' => true, 'translation_domain' => 'HVGAgentBundle' ));
            $menu['topmenu.create.menu']->setChildrenAttribute('class', 'dropdown-menu');
            $menu['topmenu.create.menu']->addChild('topmenu.create.ticket', array('route' => 'agent_ticket_new'));
            $menu['topmenu.create.menu']['topmenu.create.ticket']->setExtras(array('translation_domain' => 'HVGAgentBundle', 'icon' => 'ticket fa-fw'));
            $menu['topmenu.create.menu']->addChild('topmenu.create.petition', array('route' => 'agent_petition_new'));
            $menu['topmenu.create.menu']['topmenu.create.petition']->setExtras(array('translation_domain' => 'HVGAgentBundle', 'icon' => 'hand-o-up fa-fw'));

            $menu->addChild('topmenu.sent.menu', array('uri' => '#'));
            $menu['topmenu.sent.menu']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'role' => 'button', 'aria-haspopup' => 'true', 'aria-expanded' => 'false'));
            $menu['topmenu.sent.menu']->setExtras(array( 'icon' => 'arrow-up fa-fw', 'dropdown' => true, 'translation_domain' => 'HVGAgentBundle' ));
            $menu['topmenu.sent.menu']->setChildrenAttribute('class', 'dropdown-menu');
            $menu['topmenu.sent.menu']->addChild('topmenu.sent.tickets', array('route' => 'agent_ticket_sent'));
            $menu['topmenu.sent.menu']['topmenu.sent.tickets']->setExtras(array('translation_domain' => 'HVGAgentBundle', 'icon' => 'ticket fa-fw'));
            $menu['topmenu.sent.menu']->addChild('topmenu.sent.petitions', array('route' => 'agent_petition_sent'));
            $menu['topmenu.sent.menu']['topmenu.sent.petitions']->setExtras(array('translation_domain' => 'HVGAgentBundle', 'icon' => 'hand-o-up fa-fw'));

            $menu->addChild('topmenu.received.menu', array('uri' => '#'));
            $menu['topmenu.received.menu']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'role' => 'button', 'aria-haspopup' => 'true', 'aria-expanded' => 'false'));
            $menu['topmenu.received.menu']->setExtras(array( 'icon' => 'arrow-down fa-fw', 'dropdown' => true, 'translation_domain' => 'HVGAgentBundle' ));
            $menu['topmenu.received.menu']->setChildrenAttribute('class', 'dropdown-menu');
            $menu['topmenu.received.menu']->addChild('topmenu.received.tickets', array('route' => 'agent_ticket_received'));
            $menu['topmenu.received.menu']['topmenu.received.tickets']->setExtras(array('translation_domain' => 'HVGAgentBundle', 'icon' => 'ticket fa-fw'));
            $menu['topmenu.received.menu']->addChild('topmenu.received.petitions', array('route' => 'agent_petition_received'));
            $menu['topmenu.received.menu']['topmenu.received.petitions']->setExtras(array('translation_domain' => 'HVGAgentBundle', 'icon' => 'hand-o-up fa-fw'));

            $menu->addChild('topmenu.area.menu', array('uri' => '#'));
            $menu['topmenu.area.menu']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'role' => 'button', 'aria-haspopup' => 'true', 'aria-expanded' => 'false'));
            $menu['topmenu.area.menu']->setExtras(array( 'icon' => 'puzzle-piece fa-fw', 'dropdown' => true, 'translation_domain' => 'HVGAgentBundle' ));
            $menu['topmenu.area.menu']->setChildrenAttribute('class', 'dropdown-menu');
            $menu['topmenu.area.menu']->addChild('topmenu.area.tickets', array('route' => 'agent_ticket_area'));
            $menu['topmenu.area.menu']['topmenu.area.tickets']->setExtras(array('translation_domain' => 'HVGAgentBundle', 'icon' => 'ticket fa-fw'));
            $menu['topmenu.area.menu']->addChild('topmenu.area.petitions', array('route' => 'agent_petition_area'));
            $menu['topmenu.area.menu']['topmenu.area.petitions']->setExtras(array('translation_domain' => 'HVGAgentBundle', 'icon' => 'hand-o-up fa-fw'));
*/
            $menu->addChild('topmenu.ticket.menu', array('uri' => '#'));
            $menu['topmenu.ticket.menu']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'role' => 'button', 'aria-haspopup' => 'true', 'aria-expanded' => 'false'));
            $menu['topmenu.ticket.menu']->setExtras(array( 'icon' => 'ticket fa-fw', 'dropdown' => true, 'translation_domain' => 'HVGAgentBundle' ));
            $menu['topmenu.ticket.menu']->setChildrenAttribute('class', 'dropdown-menu');
            $menu['topmenu.ticket.menu']->addChild('topmenu.ticket.index', array('route' => 'exchange_ticket_index', 'routeParameters' => array('status' => 0)));
            $menu['topmenu.ticket.menu']['topmenu.ticket.index']->setExtras(array('translation_domain' => 'HVGAgentBundle'));
            $menu['topmenu.ticket.menu']->addChild('topmenu.ticketzone.index', array('route' => 'exchange_ticketzone_index', 'routeParameters' => array('status' => 0)));
            $menu['topmenu.ticket.menu']['topmenu.ticketzone.index']->setExtras(array('translation_domain' => 'HVGAgentBundle'));
            $menu['topmenu.ticket.menu']->addChild('topmenu.ticketliability.index', array('route' => 'exchange_ticketliability_index', 'routeParameters' => array('status' => 0)));
            $menu['topmenu.ticket.menu']['topmenu.ticketliability.index']->setExtras(array('translation_domain' => 'HVGAgentBundle'));

            $menu->addChild('topmenu.agentdashboard', array('route' => 'agent_dashboard_index'));
            $menu['topmenu.agentdashboard']->setExtras(array('icon' => 'dashboard fa-fw', 'translation_domain' => 'HVGAgentBundle'));
        }
/*
        if(in_array('ROLE_ADMIN', $roles)) {
            $menu->addChild('topmenu.user', array('route' => 'user_index'));
            $menu['topmenu.user']->setExtras(array('icon' => 'id-card fa-fw', 'translation_domain' => 'HVGAgentBundle'));

            $menu->addChild('topmenu.systemdashboard', array('route' => 'hvg_system_dashboard'));
            $menu['topmenu.systemdashboard']->setExtras(array('icon' => 'gears fa-fw', 'translation_domain' => 'HVGAgentBundle'));
        }
*/
        $menu->addChild('topmenu.logout', array('route' => 'fos_user_security_logout'));
        $menu['topmenu.logout']->setExtras(array('icon' => 'sign-out fa-fw', 'translation_domain' => 'HVGAgentBundle'));

        return $menu;

    }

    public function sideMenu(FactoryInterface $factory, array $options)
    {
        $roles = $this->container->get('security.token_storage')->getToken()->getUser()->getRoles();

        $sidemenu = $factory->createItem('root');
        $sidemenu->setChildrenAttribute('class', 'nav nav-pills nav-stacked');
        $sidemenu->setChildrenAttribute('id', 'side-menu');

        $sidemenu->addChild('sidemenu.datacenter', array('uri' => '#'));
        $sidemenu['sidemenu.datacenter']->setExtras(array('icon' => 'database fa-fw', 'dropdown' => true, 'translation_domain' => 'HVGAgentBundle'));
        $sidemenu['sidemenu.datacenter']->setAttributes(array('class' => 'dropdown'));
        $sidemenu['sidemenu.datacenter']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'aria-expanded' => 'false'));
        $sidemenu['sidemenu.datacenter']->setChildrenAttribute('class', 'dropdown-menu');
        $sidemenu['sidemenu.datacenter']->addChild('sidemenu.community', array('route' => 'agent_community_index'))->setExtra('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.datacenter']->addChild('sidemenu.unitgroup', array('route' => 'agent_unitgroup_index'))->setExtra('translation_domain', 'HVGAgentBundle');
//        $sidemenu['sidemenu.datacenter']->addChild('sidemenu.unit', array('route' => 'agent_unit_index'))->setExtra('translation_domain', 'HVGAgentBundle');

        $sidemenu->addChild('sidemenu.directory', array('uri' => '#'));
        $sidemenu['sidemenu.directory']->setExtras(array('icon' => 'address-book fa-fw', 'dropdown' => true, 'translation_domain' => 'HVGAgentBundle'));
        $sidemenu['sidemenu.directory']->setAttributes(array('class' => 'dropdown'));
        $sidemenu['sidemenu.directory']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'aria-expanded' => 'false'));
        $sidemenu['sidemenu.directory']->setChildrenAttribute('class', 'dropdown-menu');
        $sidemenu['sidemenu.directory']->addChild('sidemenu.person', array('route' => 'agent_person_index'))->setExtra('translation_domain', 'HVGAgentBundle');
/*
        $sidemenu->addChild('sidemenu.ticket.root', array('uri' => '#'));
        $sidemenu['sidemenu.ticket.root']->setExtras(array('icon' => 'ticket fa-fw', 'dropdown' => true, 'translation_domain' => 'HVGAgentBundle'));
        $sidemenu['sidemenu.ticket.root']->setAttributes(array('class' => 'dropdown'));
        $sidemenu['sidemenu.ticket.root']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'aria-expanded' => 'false'));
        $sidemenu['sidemenu.ticket.root']->setChildrenAttribute('class', 'dropdown-menu');
        $sidemenu['sidemenu.ticket.root']->addChild('sidemenu.ticket.new', array('route' => 'agent_ticket_new'))->setExtra('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.ticket.root']->addChild('sidemenu.ticket.sent', array('route' => 'agent_ticket_sent'))->setExtra('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.ticket.root']->addChild('sidemenu.ticket.received', array('route' => 'agent_ticket_received'))->setExtra('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.ticket.root']->addChild('sidemenu.ticket.area', array('route' => 'agent_ticket_area'))->setExtra('translation_domain', 'HVGAgentBundle');
*/
        $sidemenu->addChild('sidemenu.petition.root', array('uri' => '#'));
        $sidemenu['sidemenu.petition.root']->setExtras(array('icon' => 'hand-o-up fa-fw', 'dropdown' => true, 'translation_domain' => 'HVGAgentBundle'));
        $sidemenu['sidemenu.petition.root']->setAttributes(array('class' => 'dropdown'));
        $sidemenu['sidemenu.petition.root']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'aria-expanded' => 'false'));
        $sidemenu['sidemenu.petition.root']->setChildrenAttribute('class', 'dropdown-menu');
        $sidemenu['sidemenu.petition.root']->addChild('sidemenu.petition.new', array('route' => 'agent_petition_new'))->setExtra('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.petition.root']->addChild('sidemenu.petition.sent', array('route' => 'agent_petition_sent'))->setExtra('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.petition.root']->addChild('sidemenu.petition.received', array('route' => 'agent_petition_received'))->setExtra('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.petition.root']->addChild('sidemenu.petition.area', array('route' => 'agent_petition_area'))->setExtra('translation_domain', 'HVGAgentBundle');
        //if(in_array('ROLE_ADMIN', $roles)) $sidemenu['sidemenu.petition.root']->addChild('sidemenu.petition.index', array('route' => 'agent_petition_index'))->setExtra('translation_domain', 'HVGAgentBundle');

/*
        $sidemenu->addChild('sidemenu.resources', array('uri' => '#'));
        $sidemenu['sidemenu.resources']->setExtras(array('icon' => 'paperclip fa-fw', 'dropdown' => true, 'translation_domain' => 'HVGAgentBundle'));
        $sidemenu['sidemenu.resources']->setAttributes(array('class' => 'dropdown'));
        $sidemenu['sidemenu.resources']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'aria-expanded' => 'false'));
        $sidemenu['sidemenu.resources']->setChildrenAttribute('class', 'dropdown-menu');
        $sidemenu['sidemenu.resources']->addChild('sidemenu.communitystaff', array('route' => 'agent_communitystaff_index'))->setExtra('translation_domain', 'HVGAgentBundle');
*/

        $sidemenu->addChild('sidemenu.unit.root', array('uri' => '#'));
        $sidemenu['sidemenu.unit.root']->setExtras(array('icon' => 'home fa-fw', 'dropdown' => true, 'translation_domain' => 'HVGAgentBundle'));
        $sidemenu['sidemenu.unit.root']->setAttributes(array('class' => 'dropdown'));
        $sidemenu['sidemenu.unit.root']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'aria-expanded' => 'false'));
        $sidemenu['sidemenu.unit.root']->setChildrenAttribute('class', 'dropdown-menu');
        $sidemenu['sidemenu.unit.root']->addChild('sidemenu.unit.unitmemo', array('route' => 'agent_unitmemo_index'))->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array(
            'agent_unitmemo_index',
            'agent_unitmemo_new',
            'agent_unitmemo_show',
            'agent_unitmemo_edit',
            'agent_unitmemo_delete',
        )));
        $sidemenu['sidemenu.unit.root']->addChild('sidemenu.unit.guest', array('route' => 'agent_guest_index'))->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array(
            'agent_guest_index',
            'agent_guest_new',
            'agent_guest_show',
            'agent_guest_edit',
            'agent_guest_delete',
        )));
        $sidemenu['sidemenu.unit.root']->addChild('sidemenu.unit.unitresident', array('route' => 'agent_unitresident_index'))->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array(
            'agent_unitresident_index',
            'agent_unitresident_new',
            'agent_unitresident_show',
            'agent_unitresident_edit',
            'agent_unitresident_delete',
        )));
        $sidemenu['sidemenu.unit.root']->addChild('sidemenu.unit.pet', array('route' => 'agent_pet_index'))->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array(
            'agent_pet_index',
            'agent_pet_new',
            'agent_pet_show',
            'agent_pet_edit',
            'agent_pet_delete',
        )));
        $sidemenu['sidemenu.unit.root']->addChild('sidemenu.unit.warehouse', array('route' => 'agent_warehouse_index'))->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array(
            'agent_warehouse_index',
            'agent_warehouse_new',
            'agent_warehouse_show',
            'agent_warehouse_edit',
            'agent_warehouse_delete',
        )));

        $sidemenu->addChild('sidemenu.community.root', array('uri' => '#'));
        $sidemenu['sidemenu.community.root']->setExtras(array('icon' => 'group fa-fw', 'dropdown' => true, 'translation_domain' => 'HVGAgentBundle'));
        $sidemenu['sidemenu.community.root']->setAttributes(array('class' => 'dropdown'));
        $sidemenu['sidemenu.community.root']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'aria-expanded' => 'false'));
        $sidemenu['sidemenu.community.root']->setChildrenAttribute('class', 'dropdown-menu');
        $sidemenu['sidemenu.community.root']->addChild('sidemenu.community.carpark', array('route' => 'agent_carpark_index'))->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array(
            'agent_carpark_index',
            'agent_carpark_new',
            'agent_carpark_show',
            'agent_carpark_edit',
            'agent_carpark_delete',
        )));
        $sidemenu['sidemenu.community.root']->addChild('sidemenu.community.guestcarpark', array('route' => 'agent_guestcarpark_index'))->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array(
            'agent_guestcarpark_index',
            'agent_guestcarpark_new',
            'agent_guestcarpark_show',
            'agent_guestcarpark_edit',
            'agent_guestcarpark_delete',
        )));
        $sidemenu['sidemenu.community.root']->addChild('sidemenu.community.communityevent', array('route' => 'agent_communityevent_index'))->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array(
            'agent_communityevent_index',
            'agent_communityevent_new',
            'agent_communityevent_show',
            'agent_communityevent_edit',
            'agent_communityevent_delete',
        )));

        $sidemenu['sidemenu.datacenter']->addChild('sidemenu.unitinsurancepolicy', array('route' => 'agent_unitinsurancepolicy_index'));
        $sidemenu['sidemenu.datacenter']['sidemenu.unitinsurancepolicy']->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array('agent_unitinsurancepolicy_index')));

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

        $tabs->addChild('unitmemo', array('route' => 'agent_unitmemo_index', 'routeParameters' => array('community' => $community,'unitgroup' => $unitgroup,'unit' => $unit)));
        $tabs['unitmemo']->setLabel('unitmemo.index.title');
        $tabs['unitmemo']->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array(
            'agent_unitmemo_index',
            'agent_unitmemo_show',
            'agent_unitmemo_new',
            'agent_unitmemo_edit',
            'agent_unitmemo_delete',
        )));

        $tabs->addChild('guest', array('route' => 'agent_guest_index', 'routeParameters' => array('community' => $community,'unitgroup' => $unitgroup,'unit' => $unit)));
        $tabs['guest']->setLabel('guest.index.title');
        $tabs['guest']->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array(
            'agent_guest_index',
            'agent_guest_show',
            'agent_guest_new',
            'agent_guest_edit',
            'agent_guest_delete',
        )));

        $tabs->addChild('unitresident', array('route' => 'agent_unitresident_index', 'routeParameters' => array('community' => $community,'unitgroup' => $unitgroup,'unit' => $unit)));
        $tabs['unitresident']->setLabel('unitresident.index.title');
        $tabs['unitresident']->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array(
            'agent_unitresident_index',
            'agent_unitresident_show',
            'agent_unitresident_new',
            'agent_unitresident_edit',
            'agent_unitresident_delete',
        )));

        $tabs->addChild('pet', array('route' => 'agent_pet_index', 'routeParameters' => array('community' => $community,'unitgroup' => $unitgroup,'unit' => $unit)));
        $tabs['pet']->setLabel('pet.index.title');
        $tabs['pet']->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array(
            'agent_pet_index',
            'agent_pet_show',
            'agent_pet_new',
            'agent_pet_edit',
            'agent_pet_delete',
        )));

        $tabs->addChild('warehouse', array('route' => 'agent_warehouse_index', 'routeParameters' => array('community' => $community,'unitgroup' => $unitgroup,'unit' => $unit)));
        $tabs['warehouse']->setLabel('warehouse.index.title');
        $tabs['warehouse']->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array(
            'agent_warehouse_index',
            'agent_warehouse_show',
            'agent_warehouse_new',
            'agent_warehouse_edit',
            'agent_warehouse_delete',
        )));

        return $tabs;
    }

    public function communityTabsMenu(FactoryInterface $factory, array $options)
    {
        $request = $this->container->get('request');
        $community = $options['community'] ? $options['community']->getId() : null;

        $communityTabs = $factory->createItem('root');
        $communityTabs->setChildrenAttribute('class', 'nav nav-pills');
        $communityTabs->setChildrenAttribute('id', 'communityTabs-menu');

        $communityTabs->addChild('carpark', array('route' => 'agent_carpark_index', 'routeParameters' => array('community' => $community)));
        $communityTabs['carpark']->setLabel('carpark.index.title');
        $communityTabs['carpark']->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array(
            'agent_carpark_index',
            'agent_carpark_show',
            'agent_carpark_new',
            'agent_carpark_edit',
            'agent_carpark_delete',
        )));

        $communityTabs->addChild('guestcarpark', array('route' => 'agent_guestcarpark_index', 'routeParameters' => array('community' => $community)));
        $communityTabs['guestcarpark']->setLabel('guestcarpark.index.title');
        $communityTabs['guestcarpark']->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array(
            'agent_guestcarpark_index',
            'agent_guestcarpark_show',
            'agent_guestcarpark_new',
            'agent_guestcarpark_edit',
            'agent_guestcarpark_delete',
        )));

        $communityTabs->addChild('communityevent', array('route' => 'agent_communityevent_index', 'routeParameters' => array('community' => $community)));
        $communityTabs['communityevent']->setLabel('communityevent.index.title');
        $communityTabs['communityevent']->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array(
            'agent_communityevent_index',
            'agent_communityevent_show',
            'agent_communityevent_new',
            'agent_communityevent_edit',
            'agent_communityevent_delete',
        )));

        return $communityTabs;
    }

}