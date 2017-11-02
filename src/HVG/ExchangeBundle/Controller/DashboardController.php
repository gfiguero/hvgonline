<?php

namespace HVG\ExchangeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        return $this->render('HVGExchangeBundle:Dashboard:index.html.twig');
    }
}
