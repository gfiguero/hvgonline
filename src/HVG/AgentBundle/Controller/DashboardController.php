<?php

namespace HVG\AgentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        return $this->render('HVGAgentBundle:Dashboard:index.html.twig');
    }

}
