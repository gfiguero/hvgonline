<?php

namespace HVG\ProcessBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HVGProcessBundle:Default:index.html.twig');
    }
}
