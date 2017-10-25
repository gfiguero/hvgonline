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
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menu->setChildrenAttribute('id', 'top-menu');

        if(in_array('ROLE_AGENT', $roles)) {

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


            $menu->addChild('topmenu.agentdashboard', array('route' => 'agent_dashboard_index'));
            $menu['topmenu.agentdashboard']->setExtras(array('icon' => 'dashboard fa-fw', 'translation_domain' => 'HVGAgentBundle'));
        }

        if(in_array('ROLE_ADMIN', $roles)) {
            $menu->addChild('topmenu.user', array('route' => 'user_index'));
            $menu['topmenu.user']->setExtras(array('icon' => 'id-card fa-fw', 'translation_domain' => 'HVGAgentBundle'));

            $menu->addChild('topmenu.systemdashboard', array('route' => 'hvg_system_dashboard'));
            $menu['topmenu.systemdashboard']->setExtras(array('icon' => 'gears fa-fw', 'translation_domain' => 'HVGAgentBundle'));
        }

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

        $sidemenu->addChild('sidemenu.ticket.root', array('uri' => '#'));
        $sidemenu['sidemenu.ticket.root']->setExtras(array('icon' => 'ticket fa-fw', 'dropdown' => true, 'translation_domain' => 'HVGAgentBundle'));
        $sidemenu['sidemenu.ticket.root']->setAttributes(array('class' => 'dropdown'));
        $sidemenu['sidemenu.ticket.root']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'aria-expanded' => 'false'));
        $sidemenu['sidemenu.ticket.root']->setChildrenAttribute('class', 'dropdown-menu');
        $sidemenu['sidemenu.ticket.root']->addChild('sidemenu.ticket.new', array('route' => 'agent_ticket_new'))->setExtra('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.ticket.root']->addChild('sidemenu.ticket.sent', array('route' => 'agent_ticket_sent'))->setExtra('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.ticket.root']->addChild('sidemenu.ticket.received', array('route' => 'agent_ticket_received'))->setExtra('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.ticket.root']->addChild('sidemenu.ticket.area', array('route' => 'agent_ticket_area'))->setExtra('translation_domain', 'HVGAgentBundle');

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

        $sidemenu->addChild('sidemenu.resources', array('uri' => '#'));
        $sidemenu['sidemenu.resources']->setExtras(array('icon' => 'paperclip fa-fw', 'dropdown' => true, 'translation_domain' => 'HVGAgentBundle'));
        $sidemenu['sidemenu.resources']->setAttributes(array('class' => 'dropdown'));
        $sidemenu['sidemenu.resources']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'aria-expanded' => 'false'));
        $sidemenu['sidemenu.resources']->setChildrenAttribute('class', 'dropdown-menu');
        $sidemenu['sidemenu.resources']->addChild('sidemenu.communitystaff', array('route' => 'agent_communitystaff_index'))->setExtra('translation_domain', 'HVGAgentBundle');

        $sidemenu->addChild('sidemenu.unitresident', array('route' => 'agent_unitresident_index'));
        $sidemenu['sidemenu.unitresident']->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array('agent_unitresident_index')));
        $sidemenu['sidemenu.unitresident']->setLabel('unitresident.index.title');

        $sidemenu['sidemenu.datacenter']->addChild('sidemenu.unitinsurancepolicy', array('route' => 'agent_unitinsurancepolicy_index'));
        $sidemenu['sidemenu.datacenter']['sidemenu.unitinsurancepolicy']->setExtras(array('translation_domain' => 'HVGAgentBundle', 'routes' => array('agent_unitinsurancepolicy_index')));

        return $sidemenu;
    }

}