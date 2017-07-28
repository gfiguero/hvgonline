<?php

namespace HVG\ContabilityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HVGContabilityBundle:Default:index.html.twig');
    }
}
