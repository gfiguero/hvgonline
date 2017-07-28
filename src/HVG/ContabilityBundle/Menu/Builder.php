<?php

namespace HVG\ContabilityBundle\Menu;

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

            $prepareLabelAttributes = array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'role' => 'button', 'aria-haspopup' => 'true', 'aria-expanded' => 'false');
            $prepareAttributes = array( 'icon' => 'plus fa-fw', 'translation_domain' => 'HVGContabilityBundle' );
            $menu->addChild('topmenu.create.menu')->setLabelAttributes($prepareLabelAttributes)->setAttributes($prepareAttributes);
            $menu['topmenu.create.menu']->setChildrenAttribute('class', 'dropdown-menu');
            $menu['topmenu.create.menu']->addChild('topmenu.create.ticket', array('route' => '#'))->setAttribute('translation_domain', 'HVGContabilityBundle')->setAttribute('icon', 'ticket fa-fw');
            $menu['topmenu.create.menu']->addChild('topmenu.create.petition', array('route' => '#'))->setAttribute('translation_domain', 'HVGContabilityBundle')->setAttribute('icon', 'hand-o-up fa-fw');

            $sentLabelAttributes = array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'role' => 'button', 'aria-haspopup' => 'true', 'aria-expanded' => 'false');
            $sentAttributes = array( 'icon' => 'arrow-up fa-fw', 'translation_domain' => 'HVGContabilityBundle' );
            $menu->addChild('topmenu.sent.menu')->setLabelAttributes($sentLabelAttributes)->setAttributes($sentAttributes);
            $menu['topmenu.sent.menu']->setChildrenAttribute('class', 'dropdown-menu');
            $menu['topmenu.sent.menu']->addChild('topmenu.sent.tickets', array('route' => '#'))->setAttribute('translation_domain', 'HVGContabilityBundle')->setAttribute('icon', 'ticket fa-fw');
            $menu['topmenu.sent.menu']->addChild('topmenu.sent.petitions', array('route' => '#'))->setAttribute('translation_domain', 'HVGContabilityBundle')->setAttribute('icon', 'hand-o-up fa-fw');

            $receivedLabelAttributes = array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'role' => 'button', 'aria-haspopup' => 'true', 'aria-expanded' => 'false');
            $receivedAttributes = array( 'icon' => 'arrow-down fa-fw', 'translation_domain' => 'HVGContabilityBundle' );
            $menu->addChild('topmenu.received.menu')->setLabelAttributes($receivedLabelAttributes)->setAttributes($receivedAttributes);
            $menu['topmenu.received.menu']->setChildrenAttribute('class', 'dropdown-menu');
            $menu['topmenu.received.menu']->addChild('topmenu.received.tickets', array('route' => '#'))->setAttribute('translation_domain', 'HVGContabilityBundle')->setAttribute('icon', 'ticket fa-fw');
            $menu['topmenu.received.menu']->addChild('topmenu.received.petitions', array('route' => '#'))->setAttribute('translation_domain', 'HVGContabilityBundle')->setAttribute('icon', 'hand-o-up fa-fw');

            $areaLabelAttributes = array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'role' => 'button', 'aria-haspopup' => 'true', 'aria-expanded' => 'false');
            $areaAttributes = array( 'icon' => 'puzzle-piece fa-fw', 'translation_domain' => 'HVGContabilityBundle' );
            $menu->addChild('topmenu.area.menu')->setLabelAttributes($areaLabelAttributes)->setAttributes($areaAttributes);
            $menu['topmenu.area.menu']->setChildrenAttribute('class', 'dropdown-menu');
            $menu['topmenu.area.menu']->addChild('topmenu.area.tickets', array('route' => '#'))->setAttribute('translation_domain', 'HVGContabilityBundle')->setAttribute('icon', 'ticket fa-fw');
            $menu['topmenu.area.menu']->addChild('topmenu.area.petitions', array('route' => '#'))->setAttribute('translation_domain', 'HVGContabilityBundle')->setAttribute('icon', 'hand-o-up fa-fw');

            $menu->addChild('topmenu.agentdashboard', array('route' => '#'))->setAttribute('icon', 'dashboard fa-fw')->setAttribute('translation_domain', 'HVGContabilityBundle');
        }

        $menu->addChild('topmenu.logout', array('route' => 'fos_user_security_logout'))->setAttribute('icon', 'sign-out fa-fw')->setAttribute('translation_domain', 'HVGContabilityBundle');

        return $menu;

    }

    public function sideMenu(FactoryInterface $factory, array $options)
    {
        $roles = $this->container->get('security.token_storage')->getToken()->getUser()->getRoles();

        $sidemenu = $factory->createItem('root');
        $sidemenu->setChildrenAttribute('class', 'nav');
        $sidemenu->setChildrenAttribute('id', 'side-menu');

        $sidemenu->addChild('sidemenu.datacenter')->setAttribute('icon', 'database fa-fw')->setAttribute('translation_domain', 'HVGContabilityBundle');
        $sidemenu['sidemenu.datacenter']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['sidemenu.datacenter']->addChild('sidemenu.community', array('route' => 'agent_community_index'))->setAttribute('translation_domain', 'HVGContabilityBundle');
        $sidemenu['sidemenu.datacenter']->addChild('sidemenu.unitgroup', array('route' => 'agent_unitgroup_index'))->setAttribute('translation_domain', 'HVGContabilityBundle');
        $sidemenu['sidemenu.datacenter']->addChild('sidemenu.unit', array('route' => 'agent_unit_index'))->setAttribute('translation_domain', 'HVGContabilityBundle');
        //$sidemenu['sidemenu.datacenter']->addChild('sidemenu.person', array('route' => 'agent_person_index'))->setAttribute('translation_domain', 'HVGContabilityBundle');
        //$sidemenu['sidemenu.datacenter']->addChild('sidemenu.contact', array('route' => 'agent_contact_index'))->setAttribute('translation_domain', 'HVGContabilityBundle');
        //$sidemenu['sidemenu.datacenter']->addChild('sidemenu.provider', array('route' => 'agent_provider_index'))->setAttribute('translation_domain', 'HVGContabilityBundle');

        $sidemenu->addChild('sidemenu.directory')->setAttribute('icon', 'address-book fa-fw')->setAttribute('translation_domain', 'HVGContabilityBundle');
        $sidemenu['sidemenu.directory']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['sidemenu.directory']->addChild('sidemenu.person', array('route' => 'agent_person_index'))->setAttribute('translation_domain', 'HVGContabilityBundle');
        //$sidemenu['sidemenu.directory']->addChild('sidemenu.contact', array('route' => 'agent_contact_index'))->setAttribute('translation_domain', 'HVGContabilityBundle');

        $sidemenu->addChild('sidemenu.ticket.root')->setAttribute('icon', 'ticket fa-fw')->setAttribute('translation_domain', 'HVGContabilityBundle');
        $sidemenu['sidemenu.ticket.root']->setChildrenAttribute('class', 'nav nav-second-level collapse');
//        $sidemenu['sidemenu.ticket.root']->addChild('sidemenu.ticket.index', array('route' => 'agent_ticket_index'))->setAttribute('translation_domain', 'HVGContabilityBundle');
//        $sidemenu['sidemenu.ticket.root']->addChild('sidemenu.ticket.prepare', array('route' => 'agent_ticket_prepare'))->setAttribute('translation_domain', 'HVGContabilityBundle');
        $sidemenu['sidemenu.ticket.root']->addChild('sidemenu.ticket.new', array('route' => 'agent_ticket_new'))->setAttribute('translation_domain', 'HVGContabilityBundle');
        $sidemenu['sidemenu.ticket.root']->addChild('sidemenu.ticket.sent', array('route' => 'agent_ticket_sent'))->setAttribute('translation_domain', 'HVGContabilityBundle');
        $sidemenu['sidemenu.ticket.root']->addChild('sidemenu.ticket.received', array('route' => 'agent_ticket_received'))->setAttribute('translation_domain', 'HVGContabilityBundle');
        $sidemenu['sidemenu.ticket.root']->addChild('sidemenu.ticket.area', array('route' => 'agent_ticket_area'))->setAttribute('translation_domain', 'HVGContabilityBundle');
        //$sidemenu['sidemenu.ticket']->addChild('sidemenu.ticketaction', array('route' => 'agent_ticketaction_index'))->setAttribute('translation_domain', 'HVGContabilityBundle');

        $sidemenu->addChild('sidemenu.petition.root')->setAttribute('icon', 'hand-o-up fa-fw')->setAttribute('translation_domain', 'HVGContabilityBundle');
        $sidemenu['sidemenu.petition.root']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['sidemenu.petition.root']->addChild('sidemenu.petition.new', array('route' => 'agent_petition_new'))->setAttribute('translation_domain', 'HVGContabilityBundle');
        $sidemenu['sidemenu.petition.root']->addChild('sidemenu.petition.sent', array('route' => 'agent_petition_sent'))->setAttribute('translation_domain', 'HVGContabilityBundle');
        $sidemenu['sidemenu.petition.root']->addChild('sidemenu.petition.received', array('route' => 'agent_petition_received'))->setAttribute('translation_domain', 'HVGContabilityBundle');
        $sidemenu['sidemenu.petition.root']->addChild('sidemenu.petition.area', array('route' => 'agent_petition_area'))->setAttribute('translation_domain', 'HVGContabilityBundle');
        if(in_array('ROLE_ADMIN', $roles)) $sidemenu['sidemenu.petition.root']->addChild('sidemenu.petition.index', array('route' => 'agent_petition_index'))->setAttribute('translation_domain', 'HVGContabilityBundle');
        //$sidemenu['sidemenu.petition']->addChild('sidemenu.petitionaction', array('route' => 'agent_petitionaction_index'))->setAttribute('translation_domain', 'HVGContabilityBundle');

        $sidemenu->addChild('sidemenu.resources')->setAttribute('icon', 'paperclip fa-fw')->setAttribute('translation_domain', 'HVGContabilityBundle');
        $sidemenu['sidemenu.resources']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['sidemenu.resources']->addChild('sidemenu.communitystaff', array('route' => 'agent_communitystaff_index'))->setAttribute('translation_domain', 'HVGContabilityBundle');

        $sidemenu->addChild('sidemenu.contability')->setAttribute('icon', 'usd fa-fw')->setAttribute('translation_domain', 'HVGContabilityBundle');
        $sidemenu['sidemenu.contability']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['sidemenu.contability']->addChild('sidemenu.expenditure.index', array('route' => 'agent_expenditure_index'))->setAttribute('translation_domain', 'HVGContabilityBundle');
        $sidemenu['sidemenu.contability']->addChild('sidemenu.outflow.index', array('route' => 'agent_outflow_index'))->setAttribute('translation_domain', 'HVGContabilityBundle');

        return $sidemenu;
    }

}