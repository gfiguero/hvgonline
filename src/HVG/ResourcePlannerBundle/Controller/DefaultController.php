<?php

namespace HVG\ResourcePlannerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HVGResourcePlannerBundle:Default:index.html.twig');
    }
}
