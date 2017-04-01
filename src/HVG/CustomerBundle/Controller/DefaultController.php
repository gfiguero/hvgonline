<?php

namespace HVG\CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HVGCustomerBundle:Default:index.html.twig');
    }
}
