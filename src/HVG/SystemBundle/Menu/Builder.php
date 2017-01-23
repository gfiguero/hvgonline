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

        $sidemenu->addChild('requirement.sidemenu.root')->setAttribute('icon', 'list fa-fw')->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['requirement.sidemenu.root']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['requirement.sidemenu.root']->addChild('requirement.sidemenu.index', array('route' => 'requirement_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['requirement.sidemenu.root']->addChild('agent.sidemenu.index', array('route' => 'agent_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['requirement.sidemenu.root']->addChild('requirementType.sidemenu.index', array('route' => 'requirement_type_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        
        $sidemenu->addChild('provider.sidemenu.root')->setAttribute('icon', 'list fa-fw')->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['provider.sidemenu.root']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['provider.sidemenu.root']->addChild('provider.sidemenu.index', array('route' => 'provider_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['provider.sidemenu.root']->addChild('bankAccount.sidemenu.index', array('route' => 'bank_account_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        
        $sidemenu->addChild('supervisorsLog.sidemenu.root')->setAttribute('icon', 'list fa-fw')->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['supervisorsLog.sidemenu.root']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['supervisorsLog.sidemenu.root']->addChild('supervisorsLog.sidemenu.index', array('route' => 'supervisorslog_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
        

        $sidemenu->addChild('contabilidad.sidemenu.root')->setAttribute('icon', 'list fa-fw')->setAttribute('translation_domain', 'HVGSystemBundle');
        $sidemenu['contabilidad.sidemenu.root']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['contabilidad.sidemenu.root']->addChild('payOrder.sidemenu.index', array('route' => 'pay_order_index'))->setAttribute('translation_domain', 'HVGSystemBundle');
    
        return $sidemenu;
    }

}