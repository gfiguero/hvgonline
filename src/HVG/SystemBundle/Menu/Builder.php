<?php

namespace HVG\SystemBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function topMenu(FactoryInterface $factory, array $options)
    {

        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menu->setChildrenAttribute('id', 'top-menu');
        $menu->addChild('topmenu.user', array('route' => 'user_index'))->setAttribute('icon', 'id-card fa-fw')->setAttribute('translation_domain', 'HVGSystemBundle');
        $menu->addChild('topmenu.agentdashboard', array('route' => 'hvg_agent_dashboard'))->setAttribute('icon', 'dashboard fa-fw')->setAttribute('translation_domain', 'HVGSystemBundle');
        $menu->addChild('topmenu.systemdashboard', array('route' => 'hvg_system_dashboard'))->setAttribute('icon', 'gears fa-fw')->setAttribute('translation_domain', 'HVGSystemBundle');
        $menu->addChild('topmenu.logout', array('route' => 'fos_user_security_logout'))->setAttribute('icon', 'sign-out fa-fw')->setAttribute('translation_domain', 'HVGSystemBundle');

        return $menu;

    }

    public function sideMenu(FactoryInterface $factory, array $options)
    {

        $sidemenu = $factory->createItem('root');
        $sidemenu->setChildrenAttribute('class', 'nav');
        $sidemenu->setChildrenAttribute('id', 'side-menu');

        $sidemenu->addChild('sidemenu.configuration.root')->setAttribute('icon', 'list fa-fw')->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.configuration.root']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['sidemenu.configuration.root']->addChild('sidemenu.configuration.person', array('route' => 'person_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.configuration.root']->addChild('sidemenu.configuration.community', array('route' => 'community_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.configuration.root']->addChild('sidemenu.configuration.building', array('route' => 'building_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.configuration.root']->addChild('sidemenu.configuration.unit', array('route' => 'unit_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.configuration.root']->addChild('sidemenu.configuration.area', array('route' => 'area_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.configuration.root']->addChild('sidemenu.configuration.fund', array('route' => 'fund_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.configuration.root']->addChild('sidemenu.configuration.provider', array('route' => 'provider_index'))->setAttribute('translation_domain', 'HVGSystemBundle');

        $sidemenu->addChild('sidemenu.resource.root')->setAttribute('icon', 'list fa-fw')->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.resource.root']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['sidemenu.resource.root']->addChild('sidemenu.resource.role', array('route' => 'role_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.resource.root']->addChild('sidemenu.resource.communitystaff', array('route' => 'communitystaff_index'))->setAttribute('translation_domain', 'HVGSystemBundle');

        $sidemenu->addChild('sidemenu.accounting.root')->setAttribute('icon', 'list fa-fw')->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.accounting.root']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['sidemenu.accounting.root']->addChild('sidemenu.accounting.expenditure', array('route' => 'expenditure_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.accounting.root']->addChild('sidemenu.accounting.payment', array('route' => 'payment_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.accounting.root']->addChild('sidemenu.accounting.outflow', array('route' => 'outflow_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.accounting.root']->addChild('sidemenu.accounting.inflow', array('route' => 'inflow_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.accounting.root']->addChild('sidemenu.accounting.charge', array('route' => 'charge_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.accounting.root']->addChild('sidemenu.accounting.allowance', array('route' => 'allowance_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.accounting.root']->addChild('sidemenu.accounting.allowancecharge', array('route' => 'allowancecharge_index'))->setAttribute('translation_domain', 'HVGSystemBundle');

        $sidemenu->addChild('sidemenu.ticket.root')->setAttribute('icon', 'list fa-fw')->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.ticket.root']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['sidemenu.ticket.root']->addChild('sidemenu.ticket.ticket', array('route' => 'ticket_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.ticket.root']->addChild('sidemenu.ticket.ticketstatus', array('route' => 'ticketstatus_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.ticket.root']->addChild('sidemenu.ticket.ticketaction', array('route' => 'ticketaction_index'))->setAttribute('translation_domain', 'HVGSystemBundle');

        $sidemenu->addChild('sidemenu.petition.root')->setAttribute('icon', 'list fa-fw')->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.petition.root']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['sidemenu.petition.root']->addChild('sidemenu.petition.petition', array('route' => 'petition_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.petition.root']->addChild('sidemenu.petition.petitionstatus', array('route' => 'petitionstatus_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.petition.root']->addChild('sidemenu.petition.petitionaction', array('route' => 'petitionaction_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.petition.root']->addChild('sidemenu.petition.petitionevaluation', array('route' => 'petitionevaluation_index'))->setAttribute('translation_domain', 'HVGSystemBundle');

        $sidemenu->addChild('sidemenu.project.root')->setAttribute('icon', 'list fa-fw')->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.project.root']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['sidemenu.project.root']->addChild('sidemenu.project.project', array('route' => 'project_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.project.root']->addChild('sidemenu.project.projectobservation', array('route' => 'projectobservation_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.project.root']->addChild('sidemenu.project.projectaction', array('route' => 'projectaction_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.project.root']->addChild('sidemenu.project.projectstatus', array('route' => 'projectstatus_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['sidemenu.project.root']->addChild('sidemenu.project.projectproposal', array('route' => 'projectproposal_index'))->setAttribute('translation_domain', 'HVGSystemBundle');

        return $sidemenu;
    }

}