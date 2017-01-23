<?php

namespace HVG\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HVGUserBundle:Default:index.html.twig');
    }
}
