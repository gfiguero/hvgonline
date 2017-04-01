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
//        $menu->addChild('frontpage.index.link', array('route' => 'unisystem_frontpage_main'))->setAttribute('icon', 'flag fa-fw')->setAttribute('translation_domain', 'HVGSystemBundle');

        return $menu;

    }

    public function sideMenu(FactoryInterface $factory, array $options)
    {

        $sidemenu = $factory->createItem('root');
        $sidemenu->setChildrenAttribute('class', 'nav');
        $sidemenu->setChildrenAttribute('id', 'side-menu');

        $sidemenu->addChild('configuration.sidemenu.root')->setAttribute('icon', 'list fa-fw')->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['configuration.sidemenu.root']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['configuration.sidemenu.root']->addChild('person.sidemenu.index', array('route' => 'person_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['configuration.sidemenu.root']->addChild('agent.sidemenu.index', array('route' => 'agent_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['configuration.sidemenu.root']->addChild('community.sidemenu.index', array('route' => 'community_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['configuration.sidemenu.root']->addChild('building.sidemenu.index', array('route' => 'building_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['configuration.sidemenu.root']->addChild('unit.sidemenu.index', array('route' => 'unit_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['configuration.sidemenu.root']->addChild('area.sidemenu.index', array('route' => 'area_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['configuration.sidemenu.root']->addChild('fund.sidemenu.index', array('route' => 'fund_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['configuration.sidemenu.root']->addChild('provider.sidemenu.index', array('route' => 'provider_index'))->setAttribute('translation_domain', 'HVGSystemBundle');

        $sidemenu->addChild('accounting.sidemenu.root')->setAttribute('icon', 'list fa-fw')->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['accounting.sidemenu.root']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['accounting.sidemenu.root']->addChild('expenditure.sidemenu.index', array('route' => 'expenditure_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['accounting.sidemenu.root']->addChild('payment.sidemenu.index', array('route' => 'payment_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['accounting.sidemenu.root']->addChild('outflow.sidemenu.index', array('route' => 'outflow_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['accounting.sidemenu.root']->addChild('inflow.sidemenu.index', array('route' => 'inflow_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['accounting.sidemenu.root']->addChild('charge.sidemenu.index', array('route' => 'charge_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['accounting.sidemenu.root']->addChild('allowance.sidemenu.index', array('route' => 'allowance_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['accounting.sidemenu.root']->addChild('allowancecharge.sidemenu.index', array('route' => 'allowancecharge_index'))->setAttribute('translation_domain', 'HVGSystemBundle');

        $sidemenu->addChild('ticket.sidemenu.root')->setAttribute('icon', 'list fa-fw')->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['ticket.sidemenu.root']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['ticket.sidemenu.root']->addChild('ticket.sidemenu.index', array('route' => 'ticket_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['ticket.sidemenu.root']->addChild('ticketstatus.sidemenu.index', array('route' => 'ticketstatus_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['ticket.sidemenu.root']->addChild('ticketaction.sidemenu.index', array('route' => 'ticketaction_index'))->setAttribute('translation_domain', 'HVGSystemBundle');

        $sidemenu->addChild('petition.sidemenu.root')->setAttribute('icon', 'list fa-fw')->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['petition.sidemenu.root']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['petition.sidemenu.root']->addChild('petition.sidemenu.index', array('route' => 'petition_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['petition.sidemenu.root']->addChild('petitionstatus.sidemenu.index', array('route' => 'petitionstatus_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['petition.sidemenu.root']->addChild('petitionaction.sidemenu.index', array('route' => 'petitionaction_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['petition.sidemenu.root']->addChild('petitionevaluation.sidemenu.index', array('route' => 'petitionevaluation_index'))->setAttribute('translation_domain', 'HVGSystemBundle');

        $sidemenu->addChild('project.sidemenu.root')->setAttribute('icon', 'list fa-fw')->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['project.sidemenu.root']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['project.sidemenu.root']->addChild('project.sidemenu.index', array('route' => 'project_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['project.sidemenu.root']->addChild('projectobservation.sidemenu.index', array('route' => 'projectobservation_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['project.sidemenu.root']->addChild('projectaction.sidemenu.index', array('route' => 'projectaction_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['project.sidemenu.root']->addChild('projectcommand.sidemenu.index', array('route' => 'projectcommand_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['project.sidemenu.root']->addChild('projectstatus.sidemenu.index', array('route' => 'projectstatus_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['project.sidemenu.root']->addChild('projectproposal.sidemenu.index', array('route' => 'projectproposal_index'))->setAttribute('translation_domain', 'HVGSystemBundle');

        return $sidemenu;
    }

}