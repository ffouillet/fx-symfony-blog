<?php

namespace Fx\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FxPortfolioBundle:Default:index.html.twig');
    }
}
