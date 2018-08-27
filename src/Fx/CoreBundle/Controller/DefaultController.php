<?php

namespace Fx\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FxCoreBundle:Default:index.html.twig');
    }
}
