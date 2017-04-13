<?php

namespace HVG\SystemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        return $this->render('HVGSystemBundle:Dashboard:index.html.twig');
    }

}
