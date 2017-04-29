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
        $roles = $this->container->get('security.token_storage')->getToken()->getUser()->getRoles();

        $sidemenu = $factory->createItem('root');
        $sidemenu->setChildrenAttribute('class', 'nav');
        $sidemenu->setChildrenAttribute('id', 'side-menu');

        $sidemenu->addChild('sidemenu.datacenter')->setAttribute('icon', 'database fa-fw')->setAttribute('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.datacenter']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['sidemenu.datacenter']->addChild('sidemenu.community', array('route' => 'agent_community_index'))->setAttribute('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.datacenter']->addChild('sidemenu.unitgroup', array('route' => 'agent_unitgroup_index'))->setAttribute('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.datacenter']->addChild('sidemenu.unit', array('route' => 'agent_unit_index'))->setAttribute('translation_domain', 'HVGAgentBundle');
        //$sidemenu['sidemenu.datacenter']->addChild('sidemenu.person', array('route' => 'agent_person_index'))->setAttribute('translation_domain', 'HVGAgentBundle');
        //$sidemenu['sidemenu.datacenter']->addChild('sidemenu.contact', array('route' => 'agent_contact_index'))->setAttribute('translation_domain', 'HVGAgentBundle');
        //$sidemenu['sidemenu.datacenter']->addChild('sidemenu.provider', array('route' => 'agent_provider_index'))->setAttribute('translation_domain', 'HVGAgentBundle');

        $sidemenu->addChild('sidemenu.directory')->setAttribute('icon', 'address-book fa-fw')->setAttribute('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.directory']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['sidemenu.directory']->addChild('sidemenu.person', array('route' => 'agent_person_index'))->setAttribute('translation_domain', 'HVGAgentBundle');
        //$sidemenu['sidemenu.directory']->addChild('sidemenu.contact', array('route' => 'agent_contact_index'))->setAttribute('translation_domain', 'HVGAgentBundle');

        $sidemenu->addChild('sidemenu.ticket')->setAttribute('icon', 'ticket fa-fw')->setAttribute('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.ticket']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['sidemenu.ticket']->addChild('sidemenu.ticket', array('route' => 'agent_ticket_index'))->setAttribute('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.ticket']->addChild('sidemenu.myticket', array('route' => 'agent_ticket_my'))->setAttribute('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.ticket']->addChild('sidemenu.ticketaction', array('route' => 'agent_ticketaction_index'))->setAttribute('translation_domain', 'HVGAgentBundle');

        $sidemenu->addChild('sidemenu.petition')->setAttribute('icon', 'hand-o-up fa-fw')->setAttribute('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.petition']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        if(in_array('ROLE_ADMIN', $roles)) $sidemenu['sidemenu.petition']->addChild('sidemenu.petition', array('route' => 'agent_petition_index'))->setAttribute('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.petition']->addChild('sidemenu.mypetition', array('route' => 'agent_petition_my'))->setAttribute('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.petition']->addChild('sidemenu.petitionaction', array('route' => 'agent_petitionaction_index'))->setAttribute('translation_domain', 'HVGAgentBundle');

        $sidemenu->addChild('sidemenu.resources')->setAttribute('icon', 'paperclip fa-fw')->setAttribute('translation_domain', 'HVGAgentBundle');
        $sidemenu['sidemenu.resources']->setChildrenAttribute('class', 'nav nav-second-level collapse');
        $sidemenu['sidemenu.resources']->addChild('sidemenu.communitystaff', array('route' => 'agent_communitystaff_index'))->setAttribute('translation_domain', 'HVGAgentBundle');

        return $sidemenu;
    }

}