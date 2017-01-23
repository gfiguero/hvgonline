<?php

namespace HVG\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HVGAdminBundle:Default:index.html.twig');
    }
}
